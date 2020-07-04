<?php

namespace App\Http\Controllers\Api;
use App\MenuSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MenuSection as MenuSectionResource;


class MenuSectionController extends Controller
{
    //
    public function index(Request $request)
    {
        $menuSections = MenuSection::all();
        return response()->json($menuSections,200);
    }

    public function show(MenuSection $menuSection)
    {
        /* TODO return a resource */
        return response()->json($menuSection,200);
    }

    public function update(MenuSection $menuSection, Request $request)
    {
        $menuSection->update($request->input());
        return response()->json(['message'=>'ok'],200);
    }

    public function create(Request $request) 
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'menu_id' => 'exists:menus,id'
        ]);
        
        /*its passed validation if it got here*/
        $menuSection = MenuSection::create($request->input());
        return new MenuSectionResource($menuSection);
    }
    /* TODO Lots of validation to come of course.. */
    public function bulkUpdate(Request $request)
    {
        foreach($request->input('sections') as $menuSectionData)
        {
                $menuSection = MenuSection::findOrFail($menuSectionData['id']);
                 $menuSection->update($menuSectionData);
        }
        return response()->json(['message'=>'ok'],200);
    }

    public function delete(MenuSection $menuSection) {
        if($menuSection->delete()){
            return response()->json(['message'=>'deleted'],200);
        }else{
            return response()->json(['message'=>'Not found, could not delete'],404);
        }
    }
}
