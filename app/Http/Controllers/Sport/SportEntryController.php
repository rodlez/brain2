<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Http\Requests\SportStoreRequest;
use Illuminate\Http\Request;

use App\Models\Sport\SportCategory;
use App\Models\Sport\SportTag;

class SportEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sport/entry.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* $categories = SportCategory::orderBy('name')->get();
        $tags       = SportTag::orderBy('name')->get();

        return view('sport/entry.create', [
            'categories'    => $categories,
            'tags'          => $tags
        ]); */
        return view('sport/entry/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SportStoreRequest $request)
    {
        // Retrieve the validated input data...
        $formData   = $request->validated();
        dd($formData);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
