<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\HasMedia;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Person extends Model
{
    use HasFactory, Uuid, BelongsToTenant;

    protected $guarded = [];

    protected $casts = [
        'birthday' => 'date',
        'baptism_date' => 'date',
        'receipt_date' => 'date',
        'affiliation_date' => 'date',
    ];

    public function ecclesiasticalRole()
    {
        return $this->belongsTo(EcclesiasticalRole::class);
    }

    public function personAddresses()
    {
        return $this->hasMany(PersonAddress::class);
    }

    public function personPhones()
    {
        return $this->hasMany(PersonPhone::class);
    }

    public function personEmails()
    {
        return $this->hasMany(PersonEmail::class);
    }

    public function personDocuments()
    {
        return $this->hasMany(PersonDocument::class);
    }
}
