<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'invoices';

    protected $dates = [
        'date',
        'date_due',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'name',
        'invoice_number',
        'date',
        'date_due',
        'status',
    ];

    public const STATUS_SELECT = [
        'Paid'    => 'Paid',
        'Pending' => 'Pending',
        'Overdue' => 'Overdue',
    ];

    protected $fillable = [
        'name',
        'invoice_number',
        'date',
        'date_due',
        'amount',
        'tax',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class);
    }

    public function landlords()
    {
        return $this->belongsToMany(Landlord::class);
    }

    public function invoice_types()
    {
        return $this->belongsToMany(InvoiceType::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

    public function units()
    {
        return $this->belongsToMany(Unit::class);
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getDateDueAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateDueAttribute($value)
    {
        $this->attributes['date_due'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
