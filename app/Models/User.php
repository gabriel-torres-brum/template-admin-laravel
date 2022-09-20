<?php

namespace App\Models;

use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class User extends BaseUser
{
    use BelongsToTenant;
}
