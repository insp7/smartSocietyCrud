<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsiderImage extends Model
{
    protected $fillable = ['insider_id', 'image_path', 'created_by', 'updated_by'];

    public function insider() {
        return $this->belongsTo('App\Insider');
    }
}
