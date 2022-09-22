<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class FinancialReportFinancialTransaction extends Pivot
{
    use Uuid, BelongsToTenant;

    protected $guarded = [];
        
    protected $table = 'financial_reports_transactions';
}
