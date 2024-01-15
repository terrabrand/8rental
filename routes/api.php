<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Landlord
    Route::apiResource('landlords', 'LandlordApiController');

    // Tenant
    Route::post('tenants/media', 'TenantApiController@storeMedia')->name('tenants.storeMedia');
    Route::apiResource('tenants', 'TenantApiController');

    // Properties
    Route::post('properties/media', 'PropertiesApiController@storeMedia')->name('properties.storeMedia');
    Route::apiResource('properties', 'PropertiesApiController');

    // Sections
    Route::apiResource('sections', 'SectionsApiController');

    // Units
    Route::post('units/media', 'UnitsApiController@storeMedia')->name('units.storeMedia');
    Route::apiResource('units', 'UnitsApiController');

    // Maintainers
    Route::post('maintainers/media', 'MaintainersApiController@storeMedia')->name('maintainers.storeMedia');
    Route::apiResource('maintainers', 'MaintainersApiController');

    // Expense Type
    Route::apiResource('expense-types', 'ExpenseTypeApiController');

    // Expenses
    Route::apiResource('expenses', 'ExpensesApiController');

    // Document Type
    Route::apiResource('document-types', 'DocumentTypeApiController');

    // Documents
    Route::apiResource('documents', 'DocumentsApiController');

    // Invoice Type
    Route::apiResource('invoice-types', 'InvoiceTypeApiController');

    // Invoices
    Route::apiResource('invoices', 'InvoicesApiController');

    // Income Type
    Route::apiResource('income-types', 'IncomeTypeApiController');

    // Income
    Route::apiResource('incomes', 'IncomeApiController');

    // Applications
    Route::apiResource('applications', 'ApplicationsApiController');

    // Invoice Recurring
    Route::apiResource('invoice-recurrings', 'InvoiceRecurringApiController');

    // Equipments
    Route::post('equipments/media', 'EquipmentsApiController@storeMedia')->name('equipments.storeMedia');
    Route::apiResource('equipments', 'EquipmentsApiController');

    // Equipment Type
    Route::apiResource('equipment-types', 'EquipmentTypeApiController');
});
