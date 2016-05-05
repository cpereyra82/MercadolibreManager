<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description','status'
    ];

   //hacer colleccion de items en producto
    public function items(){
        return $this->hasMany('App\Item');
    }

    public function scopeSearch($query,$status){


        $query->where('status',$status);

    }
}
