<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuSection extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'menu_id'
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

    public function menu()
    {
        return $this->belongsTo('App\Menu', 'menu_id', 'id');
    }

    public function items()
    {
        return $this->hasMany('App\MenuItem','menu_section_id','id');
    }
}
