<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MenuItem;
use App\Http\Resources\MenuItem as MenuItemResource;
use App\Http\Resources\MenuItemCollection as MenuItemCollectionResource;


class MenuItemController extends Controller
{
    // TODO dont think theres a need for this endpoint
    public function index(Request $request)
    {
        $menuItems = MenuItem::all();
        return response()->json(new MenuItemCollectionResource($menuItems),200);
    }

    /*TODO set this up someday https://laravel.com/docs/master/validation#creating-form-requests */
    public function create(Request $request)
    {
  
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'menu_section_id' => 'required|exists:menu_sections,id',
            'menu_id' => 'exists:menus,id'
        ]);
        
        /*its passed validation if it got here*/
        $menuItem = MenuItem::create($request->input());
        return $menuItem;

    }

    public function show(MenuItem $menuItem)
    {
        return response()->json(new MenuItemResource($menuItem),200);
    }

    public function update(MenuItem $menuItem, Request $request)
    {
        $menuItem->update($request->input());
        return response()->json(['message'=>'ok'],200);
    }

    /* TODO Lots of validation to come of course.. */
    public function bulkUpdate(Request $request)
    {
        foreach($request->input('items') as $menuItemData)
        {
                $menuItem = MenuItem::findOrFail($menuItemData['id']);
                $menuItem->update($menuItemData);
        }
        return response()->json(['message'=>'ok'],200);
    }

    public function delete(MenuItem $menuItem)
    {
        if($menuItem->delete()){
            return response()->json(['message'=>'deleted'],200);
        }else{
            return response()->json(['message'=>'Not found, could not delete'],404);
        }
    }
}
