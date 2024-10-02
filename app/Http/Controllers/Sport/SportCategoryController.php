<?php

namespace App\Http\Controllers\Sport;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Sport\SportCategory;
use Exception;
use Illuminate\View\View;

class SportCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sport/category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sport/category/create');
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
    public function show(SportCategory $category): View
    {
        /* var_dump($category);
        gettype($category);
        die(); */
        return view('sport/category/show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SportCategory $category): View
    {
        /* var_dump($category);
        gettype($category);
        die(); */
        return view('sport/category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreCategoryRequest $request, SportCategory $category)
    {
        $formData = $request->validated();
        SportCategory::where('id', $category->id)->update($formData);
        return to_route('sportcategory.show', $category)->with('message', 'Category (' . $request->input('name') . ') updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SportCategory $category)
    {
        /* resticted access - only user who owns the category has access
        if ($category->user_id !== request()->user()->id) {
            abort(403);
        }*/
        try {
            $category->delete();

            return to_route('sportcategory.index')->with('message', 'category: ' . $category->name . ' deleted.');
        } catch (Exception $e) {

            return to_route('sportcategory.index')->with('message', 'Error(' . $e->getCode() . ') Category: ' . $category->name . ' can not be deleted.');
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function entries(SportCategory $category): View
    {
        return view('sport/category.entries', ['category' => $category]);
    }

    /**
     * Test
     */
    public function test()
    {
        $categories = implode(array_values(SportCategory::get()->pluck('id')->random(1)->toArray()));
        var_dump($categories);
        dd($categories);
        return view('sport/category.test');
    }

    /**
     * Caca
     */
    public function caca($mierda)
    {
        return view('sport/category.caca')->with('mierda', $mierda);
    }
}
