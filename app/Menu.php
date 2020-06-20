<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

use QrCode;
use App\Link;

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

    public function qrCodeURL()
    {
        if($this->link()->exists() && $this->link->qr_code_url != "")
        {
            return $this->link->path;
        }else{
            return $this->generateQRCodeURL();
        }
    }

    /* TODO will need to get a bit smarter around the sizes and formats instead of returning whatever is there*/
    public function generateQRCodeURL($size = 200, $format = 'svg')
    {
        $code = QrCode::size($size)->format($format)->generate(route('menu.show',$this));
        
        $path = "{$this->id}x{$size}.{$format}";
        $code = QrCode::size(200)->generate(route('menu.show',$this));

        /*probably need to setup S3 here*/
        Storage::disk('public')->put($path,$code);

        $this->link()->save(new Link(['qr_code_url'=>$path, 'path'=>$path]));

        return $this->link->path;

    }
}
