<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'expenses';

    public static $searchable = [
        'name',
        'description',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const STATUS_SELECT = [
        'paid'    => 'Paid',
        'pending' => 'Pending',
        'overdue' => 'Overdue',
    ];

    public const RESPONSIBLE_SELECT = [
        'Tenant'     => 'Tenant',
        'Landlord'   => 'Landlord',
        'Maintainer' => 'Maintainer',
        'Other'      => 'Other',
    ];

    protected $fillable = [
        'name',
        'responsible',
        'description',
        'amount',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function landlords()
    {
        return $this->belongsToMany(Landlord::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class);
    }

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class);
    }

    public function expense_types()
    {
        return $this->belongsToMany(ExpenseType::class);
    }
}
