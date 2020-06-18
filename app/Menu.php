<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'establishment_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];

    public function establishment()
    {
        return $this->belongsTo('App\Establishment');
    }

    public function menuItems()
    {
        return $this->hasMany('App\MenuItem');
    }

    public function menuSections()
    {
        return $this->hasMany('App\MenuSection');
    }

    public function link()
    {
        return $this->hasOne('App\Link');
    }
}
