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
}
