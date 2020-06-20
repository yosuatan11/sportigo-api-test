<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    public function Fields()
    {
        return $this->hasMany(Field::class);
    }

    protected $fillable = ['name', 'address'];
}
