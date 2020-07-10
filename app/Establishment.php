<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Establishment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'currency', 'contact_person','email_address','contact_number','address_1','address_2','town_city','postcode','county','country'
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

    public function menus()
    {
        return $this->hasMany('App\Menu');
    }
}
