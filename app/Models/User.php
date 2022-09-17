<?php

namespace App\Models;

class User extends BaseUser
{
    public function person()
    {
        return $this->hasOne(Person::class);
    }
}
