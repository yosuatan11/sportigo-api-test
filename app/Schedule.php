<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function Field()
    {
        return $this->belongsTo(Field::class);
    }

    protected $fillable = ['field_id', 'schedule'];
}
