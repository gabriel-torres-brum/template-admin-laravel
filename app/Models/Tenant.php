<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements HasMedia
{
    use HasDomains, InteractsWithMedia;

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
