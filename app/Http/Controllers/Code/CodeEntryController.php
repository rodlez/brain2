<?php

namespace App\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use App\Services\CodeService;
use Illuminate\Http\Request;

use App\Models\Code\Code;

use Illuminate\View\View;

class CodeEntryController extends Controller
{

    // Service Injection
    public function __construct(
        private CodeService $codeService,
        //private SportImageService $sportImageService,
    ) {}

    // Show the Code Main Menu

    public function main(): View
    {
        /*  $entries = $this->sportService->totalEntries();
        $categories = $this->sportService->totalCategories();
        $tags = $this->sportService->totalTags();

        return view('sport/main', [
            'totalEntries' => $entries,
            'totalCategories' => $categories,
            'totalTags' => $tags,
        ]); */
        return view('code/main');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('code/entry.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('code/entry/create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Code $entry): View
    {
        $tags = $this->codeService->displayEntryTags($entry, '/');
        //$images = $this->sportService->getImages($entry);

        return view('code/entry/show', [
            'entry'     => $entry,
            'tags'      => $tags,
            //'images'    => $images
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Code $entry): View
    {
        $selectedTags = $this->codeService->getEntryTags($entry);

        return view('code/entry/edit', [
            'entry' => $entry,
            //'selectedTags' => $selectedTags
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Code $entry)
    {
        //$images = $this->sportService->getImages($entry);
        //dd($images->count());
        //$this->sportImageService->deleteImages($images);

        $entry->delete();
        return to_route('codeentry.index')->with('message', 'Entry: ' . $entry->title . ' deleted.');
    }
}
