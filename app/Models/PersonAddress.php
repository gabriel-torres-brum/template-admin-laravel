<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonAddress extends Model
{
    use HasFactory, Uuid;

    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
