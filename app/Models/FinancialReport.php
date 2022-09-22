<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class FinancialReport extends Model
{
    use HasFactory, Uuid, BelongsToTenant;

    protected $fillable = [
        'description',
        'begin_period',
        'final_period',
    ];

    protected $casts = [
        'begin_period' => 'date',
        'final_period' => 'date',
    ];

    public function financialTransactions()
    {
        return $this->belongsToMany(FinancialTransaction::class, FinancialReportFinancialTransaction::class);
    }
}
