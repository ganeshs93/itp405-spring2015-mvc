<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sounds extends Model
{
    public function dvds()
    {
        return $this->hasMany('App\Models\Dvd');
    }
}