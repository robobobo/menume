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

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'all_day' => 'required|boolean',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i',
            'establishment_id' => 'exists:establishments,id'
        ]);
        
        /*its passed validation if it got here*/
        $menu = Menu::create($request->input());
        return new MenuResource($menu);
    }
}
