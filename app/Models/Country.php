<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = ['country_name', 'country_code'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function patients()
    {
        return $this->hasMany(Patient::class);
    }
}

