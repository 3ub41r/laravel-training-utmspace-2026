<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    public function getRouteKey()
    {
        return encrypt($this->getKey());
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
