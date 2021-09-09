<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;

class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all = Nav::all();
        $childrenIds = [];

        // replace children ID's with the actual children objects in every entry that has children.

        foreach ($all as $entry){
            if ($entry['children']) {
                $thisParentChildrenIds = explode(";", $entry['children']);
                $thisParentChildren = [];
                foreach ($thisParentChildrenIds as $value) {
                    $intValue = (int)$value;
                    array_push($childrenIds, $intValue);
                    array_push($thisParentChildren, Nav::where('id', $intValue)->first());
                }
                $entry['children'] = $thisParentChildren;
            }
        }

        // Remove Children from Main Array as they are already in their parents children attribute.

        foreach ($all as $key => $entry) {
            foreach ($childrenIds as $value) {
                if ($entry['id'] == $value) {
                    unset($all[$key]);
                }
            }
        }

        return response()->json($all);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function show(Nav $nav)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function edit(Nav $nav)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nav $nav)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nav  $nav
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nav $nav)
    {
        //
    }
}
