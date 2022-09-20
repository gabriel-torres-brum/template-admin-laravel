<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class EcclesiasticalRole extends Model
{
    use HasFactory, Uuid, BelongsToTenant;

    protected $guarded = [];

    public function people()
    {
        return $this->hasMany(Person::class);
    }
}
