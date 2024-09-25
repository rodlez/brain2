<?php

namespace App\Http\Controllers\Sport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Models\Sport\SportTag;
use Illuminate\View\View;

class SportTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sport/tag.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sport/tag/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(SportTag $tag): View
    {
        /* var_dump($tag);
        gettype($tag);
        die(); */
        return view('sport/tag/show', [
            'tag' => $tag
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SportTag $tag): View
    {
        /* var_dump($tag);
        gettype($tag);
        die(); */
        return view('sport/tag.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TagStoreRequest $request, SportTag $tag)
    {
        $formData = $request->validated();
        SportTag::where('id', $tag->id)->update($formData);
        return to_route('sporttag.show', $tag)->with('message', 'tag (' . $request->input('name') . ') updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SportTag $tag)
    {
        /* resticted access - only user who owns the tag has access
        if ($tag->user_id !== request()->user()->id) {
            abort(403);
        }*/
        $tag->delete();

        return to_route('sporttag.index')->with('message', 'tag: ' . $tag->name . ' deleted.');
    }

    /**
     * Display a listing of the resource.
     */
    public function entries(SportTag $tag): View
    {
        return view('sport/tag.entries', ['tag' => $tag]);
    }

    /**
     * Test
     */
    public function test()
    {
        return view('sport/tag.test');
    }
}
