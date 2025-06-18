<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    // Relations
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}