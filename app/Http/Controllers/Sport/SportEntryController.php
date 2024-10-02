<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;
use App\Http\Requests\SportStoreRequest;

use Illuminate\Http\Request;

use App\Models\Sport\Sport;
use App\Models\Sport\SportCategory;
use App\Models\Sport\SportTag;

use App\Services\SportService;
use App\Services\SportImageService;
use Illuminate\View\View;

class SportEntryController extends Controller
{
    // Service Injection
    public function __construct(
        private SportService $sportService,
        private SportImageService $sportImageService,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('sport/entry.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('sport/entry/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SportStoreRequest $request) {}

    /**
     * Display the specified resource.
     */
    public function show(Sport $entry): View
    {
        $tags = $this->sportService->displayEntryTags($entry, '/');
        $images = $this->sportService->getImages($entry);

        return view('sport/entry/show', [
            'entry'     => $entry,
            'tags'      => $tags,
            'images'    => $images
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sport $entry): View
    {
        $selectedTags = $this->sportService->getEntryTags($entry);

        return view('sport/entry/edit', [
            'entry' => $entry,
            //'selectedTags' => $selectedTags
        ]);
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
    public function destroy(Sport $entry)
    {
        $images = $this->sportService->getImages($entry);
        //dd($images->count());
        $this->sportImageService->deleteImages($images);

        $entry->delete();
        return to_route('sportentry.index')->with('message', 'Entry: ' . $entry->title . ' deleted.');
    }

    // test
    public function test()
    {
        return view('sport/entry/test');
    }

    // Show the Sport Main Menu

    public function main(): View
    {
        $entries = $this->sportService->totalEntries();
        $categories = $this->sportService->totalCategories();
        $tags = $this->sportService->totalTags();

        return view('sport/main', [
            'totalEntries' => $entries,
            'totalCategories' => $categories,
            'totalTags' => $tags,
        ]);
    }
}
