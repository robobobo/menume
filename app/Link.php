<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'qr_code_url', 'menu_id', 'url','path', 'establishment_id'
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

    public function establishment()
    {
        return $this->belongsTo('App\Establishment','establishment_id','id');
    }
}
