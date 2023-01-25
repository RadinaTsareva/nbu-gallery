<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Photo extends Model {

    protected $table = 'photos';

    protected $fillable = array('album_id','description','image');

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }
}
