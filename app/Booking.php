<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Field()
    {
        return $this->belongsTo(Field::class);
    }

    protected $fillable = ['user_id', 'field_id', 'time'];
}
