<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToPrimaryModel;

class PersonPhone extends Model
{
    use HasFactory, Uuid, BelongsToPrimaryModel;

    public function getRelationshipToPrimaryModel(): string
    {
        return 'person';
    }

    protected $fillable = [
        'number',
        'person_id'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
