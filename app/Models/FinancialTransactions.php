<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class FinancialTransactions extends Model implements HasMedia
{
    use HasFactory, Uuid, BelongsToTenant, InteractsWithMedia;

    protected $guarded = [];
}
