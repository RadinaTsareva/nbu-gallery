<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model {

    protected $table = 'albums';

    protected $fillable = array('name','description','cover_image');

    public function photos(): HasMany
    {
        return $this->hasMany(Photo::class);
    }
}
