<?php

namespace App\Models;

use Stancl\Tenancy\Database\Concerns\CentralConnection;

class CentralUser extends BaseUser
{
    use CentralConnection;
    public $table = "users";
}
