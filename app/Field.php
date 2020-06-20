<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    public function Bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function Schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function Place()
    {
        return $this->belongsTo(Place::class);
    }

    protected $fillable = ['place_id', 'name'];
}
