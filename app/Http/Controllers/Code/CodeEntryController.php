<?php

namespace App\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CodeEntryController extends Controller
{
    // Show the Code Main Menu

    public function main()
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
}
