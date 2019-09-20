<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CriminalImage extends Model {
    protected $fillable = ['criminal_id', 'image_path', 'created_by', 'updated_by'];

    public function criminal() {
        return $this->belongsTo('App\Criminal');
    }
}
