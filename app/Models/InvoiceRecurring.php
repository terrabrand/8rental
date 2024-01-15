<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvoiceRecurring extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'invoice_recurrings';

    protected $dates = [
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'property_id',
        'unit_id',
        'amount',
        'billing_cycle',
        'start_date',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const BILLING_CYCLE_SELECT = [
        '1day'   => '1 DAY',
        '1week'  => 'WEEKLY',
        '2week'  => 'EVERY TWO WEEKS',
        'month'  => 'MONTHLY',
        '2month' => 'EVERY TWO MONTHS',
        '3month' => 'EVERY THREE MONTHS',
        '6month' => 'EVERY SIX MONTHS',
        '9month' => 'EVERY NINE MONTHS',
        'year'   => 'EVERY YEAR',
        '2year'  => 'EVERY TWO YEARS',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
