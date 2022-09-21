<?php

namespace App\Models;

use App\Models\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Stancl\Tenancy\Database\Concerns\BelongsToPrimaryModel;

class PersonDocument extends Model implements HasMedia
{
    use HasFactory, Uuid , BelongsToPrimaryModel, InteractsWithMedia;

    public function getRelationshipToPrimaryModel(): string
    {
        return 'person';
    }

    protected $fillable = [
        'description',
        'number',
        'shipping_date',
        'person_id',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }
}
