<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class FinancialReport extends Model
{
    use HasFactory, Uuid, BelongsToTenant;

    protected $guarded = [];

    public function financialTransactions()
    {
        return $this->belongsToMany(FinancialTransaction::class, 'financial_reports_transactions');
    }
}
