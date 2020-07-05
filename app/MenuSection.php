<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuSection extends Model
{
    use SoftDeletes;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'menu_id', 'position'
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
        return $this->hasMany('App\MenuItem','menu_section_id','id')->orderBy('position','asc');
    }

     /**
   * Allows us to soft delete items
   *
   * @return void
   */
   protected static function boot() 
   {
     parent::boot();

     static::deleting(function($sections) {
        foreach ($sections->items()->get() as $item) {
           $item->delete();
        }
     });
   }
}
