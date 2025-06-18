<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function schedules()
    {
        return $this->hasMany(PaymentSchedule::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
