<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criminal extends Model {

    use SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function criminalImages() {
        return $this->hasMany('App\CriminalImage');
    }

    // declaring event handlers
    public static function boot() {
        parent::boot();

        // before delete() method call this i.e. before deleting an entry of Criminal
        static::deleting(function($insider) {
            $insider->user()->delete();
        });
    }
}
