<?php

namespace App\Http\Controllers\Code;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Models\Code\CodeCategory;
use Exception;
use Illuminate\View\View;

class CodeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('code/category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('code/category/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(CodeCategory $category): View
    {
        return view('code/category/show', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CodeCategory $category): View
    {
        return view('code/category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryStoreRequest $request, CodeCategory $category)
    {
        $formData = $request->validated();
        CodeCategory::where('id', $category->id)->update($formData);
        return to_route('codecategory.show', $category)->with('message', 'Category (' . $request->input('name') . ') successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CodeCategory $category)
    {
        /* resticted access - only user who owns the category has access
        if ($category->user_id !== request()->user()->id) {
            abort(403);
        }*/
        try {
            $category->delete();

            return to_route('codecategory.index')->with('message', 'category: ' . $category->name . ' deleted.');
        } catch (Exception $e) {

            return to_route('codecategory.index')->with('message', 'Error(' . $e->getCode() . ') Category: ' . $category->name . ' can not be deleted.');
        }
    }
}
