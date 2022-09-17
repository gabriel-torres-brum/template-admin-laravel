<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialReport extends Model
{
    use HasFactory, Uuid;

    protected $guarded = [];

    public function financialTransactions()
    {
        return $this->belongsToMany(FinancialTransactions::class, 'financial_reports_transactions');
    }
}
