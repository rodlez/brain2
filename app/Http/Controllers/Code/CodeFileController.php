<?php

namespace App\Http\Controllers\Code;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Models\Code\Code;
use App\Models\Code\CodeFile;
use App\Services\CodeFileService;
use App\Services\CodeService;

class CodeFileController extends Controller
{

    // Service Injection
    public function __construct(
        private CodeService $codeService,
        private CodeFileService $codeFileService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Code $entry): View
    {
        return view('code/file.index', ['entry' => $entry]);
    }

    /*  *
     * Store a newly created resource in storage.
     */
    /*  public function store(StoreFileRequest $request, Code $entry)
    {
        //dd($request);

        $validados = $request->validated();

        dd($validados);       

        foreach ($validados['images'] as $file) {
            # code...
            $data = $this->sportImageService->uploadImage($file, $entry, 'public', 'sport');

            SportImage::create($data);
        }

        return to_route('sportentry.show', $entry)->with('message', 'Image(s) for (' . $entry->title . ') uploaded.');
    } */

    public function download(Code $entry, CodeFile $file)
    {
        return $this->codeFileService->downloadFile($file, 'attachment');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Code $entry, CodeFile $file)
    {

        $this->codeFileService->deleteOneFile($file);

        //request()->headers->get('referer')
        //return to_route('sportentry.show', $entry)->with('message', 'Image ' . $image->original_filename . ' for : ' . $entry->title . ' deleted.');
        return back()->with('message', 'Image ' . $file->original_filename . ' for : ' . $entry->title . ' deleted.');
    }
}
