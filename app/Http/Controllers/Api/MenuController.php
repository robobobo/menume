<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Menu as MenuResource;

use Illuminate\Http\Request;
use App\Menu;

class MenuController extends Controller
{
    //
    public function show(Menu $menu)
    {
        return new MenuResource($menu);
    }
}
