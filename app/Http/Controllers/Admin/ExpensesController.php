<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyExpenseRequest;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Landlord;
use App\Models\Property;
use App\Models\Tenant;
use App\Models\Unit;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExpensesController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('expense_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expenses = Expense::with(['landlords', 'properties', 'units', 'tenants', 'expense_types'])->get();

        $landlords = Landlord::get();

        $properties = Property::get();

        $units = Unit::get();

        $tenants = Tenant::get();

        $expense_types = ExpenseType::get();

        return view('admin.expenses.index', compact('expense_types', 'expenses', 'landlords', 'properties', 'tenants', 'units'));
    }

    public function create()
    {
        abort_if(Gate::denies('expense_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landlords = Landlord::pluck('name', 'id');

        $properties = Property::pluck('property_name', 'id');

        $units = Unit::pluck('unit_name', 'id');

        $tenants = Tenant::pluck('first_name', 'id');

        $expense_types = ExpenseType::pluck('name', 'id');

        return view('admin.expenses.create', compact('expense_types', 'landlords', 'properties', 'tenants', 'units'));
    }

    public function store(StoreExpenseRequest $request)
    {
        $expense = Expense::create($request->all());
        $expense->landlords()->sync($request->input('landlords', []));
        $expense->properties()->sync($request->input('properties', []));
        $expense->units()->sync($request->input('units', []));
        $expense->tenants()->sync($request->input('tenants', []));
        $expense->expense_types()->sync($request->input('expense_types', []));

        return redirect()->route('admin.expenses.index');
    }

    public function edit(Expense $expense)
    {
        abort_if(Gate::denies('expense_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $landlords = Landlord::pluck('name', 'id');

        $properties = Property::pluck('property_name', 'id');

        $units = Unit::pluck('unit_name', 'id');

        $tenants = Tenant::pluck('first_name', 'id');

        $expense_types = ExpenseType::pluck('name', 'id');

        $expense->load('landlords', 'properties', 'units', 'tenants', 'expense_types');

        return view('admin.expenses.edit', compact('expense', 'expense_types', 'landlords', 'properties', 'tenants', 'units'));
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
        $expense->update($request->all());
        $expense->landlords()->sync($request->input('landlords', []));
        $expense->properties()->sync($request->input('properties', []));
        $expense->units()->sync($request->input('units', []));
        $expense->tenants()->sync($request->input('tenants', []));
        $expense->expense_types()->sync($request->input('expense_types', []));

        return redirect()->route('admin.expenses.index');
    }

    public function show(Expense $expense)
    {
        abort_if(Gate::denies('expense_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->load('landlords', 'properties', 'units', 'tenants', 'expense_types');

        return view('admin.expenses.show', compact('expense'));
    }

    public function destroy(Expense $expense)
    {
        abort_if(Gate::denies('expense_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $expense->delete();

        return back();
    }

    public function massDestroy(MassDestroyExpenseRequest $request)
    {
        $expenses = Expense::find(request('ids'));

        foreach ($expenses as $expense) {
            $expense->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
