<?php

namespace App\Models;

use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    use HasDomains;

    protected $fillable = [
        'id',
        'name',
        'cnpj',
        'logo'
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'cnpj',
            'logo'
        ];
    }
}
