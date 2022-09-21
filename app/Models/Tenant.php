<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDataColumn;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\VirtualColumn\VirtualColumn;

class Tenant extends BaseTenant implements HasMedia
{
    use HasDomains, InteractsWithMedia;

    protected $fillable = [
        'id',
        'name',
        'cnpj',
    ];

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'cnpj',
        ];
    }

    public function tenantPhones()
    {
        return $this->hasMany(TenantPhone::class);
    }

    public function tenantEmails()
    {
        return $this->hasMany(TenantEmail::class);
    }

    public function tenantAddresses()
    {
        return $this->hasMany(TenantAddress::class);
    }
}
