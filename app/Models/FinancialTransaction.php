<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class FinancialTransaction extends Model implements HasMedia
{
    use HasFactory, Uuid, BelongsToTenant, InteractsWithMedia;

    protected $guarded = [];

    public function financialReports()
    {
        return $this->belongsToMany(FinancialReport::class, FinancialReportFinancialTransaction::class);
    }
}
