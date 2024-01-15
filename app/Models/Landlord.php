<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Landlord extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'landlords';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'name',
        'company_name',
        'phone_number',
        'country',
        'city',
        'state',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function landlordProperties()
    {
        return $this->hasMany(Property::class, 'landlord_id', 'id');
    }

    public function landlordExpenses()
    {
        return $this->belongsToMany(Expense::class);
    }

    public function landlordDocuments()
    {
        return $this->belongsToMany(Document::class);
    }

    public function landlordInvoices()
    {
        return $this->belongsToMany(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
