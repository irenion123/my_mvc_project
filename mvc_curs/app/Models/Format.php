<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    protected $table = 'formats';
    protected $primaryKey = 'format_id';

    public function getNameAttribute()
    {
        return $this->width .' x '. $this->height;
    }

}


