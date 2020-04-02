<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Surgical extends Model implements HasMedia
{
	use HasMediaTrait;
    //

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
