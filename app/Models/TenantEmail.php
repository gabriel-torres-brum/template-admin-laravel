<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantEmail extends Model
{
    use HasFactory, Uuid;

    protected $guarded = [];
}
