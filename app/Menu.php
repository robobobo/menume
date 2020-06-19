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
            return "/storage/".$this->link->path;
        }else{
            return "/storage/".$this->generateQRCodeURL();
        }
    }

    /* TODO will need to get a bit smarter around the sizes and formats instead of returning whatever is there*/
    public function generateQRCodeURL($size = 200, $format = 'svg')
    {
        $code = QrCode::size($size)->format($format)->generate(route('menu.show',$this));
        
        $path = "qrcodes/{$this->id}x{$size}.{$format}";
        Storage::disk('public')->put($path,$code);

        $this->link()->save(new Link(['qr_code_url'=>Storage::disk('public')->url($path), 'path'=>$path]));

        return $this->link->path;

    }
}
