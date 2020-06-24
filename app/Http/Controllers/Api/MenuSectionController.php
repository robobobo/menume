<?php

namespace App\Http\Controllers\Api;
use App\MenuSection;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuSectionController extends Controller
{
    //
    public function index(Request $request)
    {
        return $request;
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
}
