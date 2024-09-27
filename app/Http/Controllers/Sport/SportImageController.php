<?php

namespace App\Http\Controllers\Sport;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreImageRequest;
use Illuminate\Http\Request;
use File;
// Models
use App\Models\Sport\Sport;
use App\Models\Sport\SportImage;
// Services
use App\Services\SportService;
use App\Services\SportImageService;

use Illuminate\Support\Facades\Storage;

class SportImageController extends Controller
{

    // Service Injection
    public function __construct(
        private SportService $sportService,
        private SportImageService $sportImageService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Sport $entry)
    {
        return view('sport/image.index', ['entry' => $entry]);
    }

    /*  *
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request, Sport $entry)
    {
        //dd($request);

        $validados = $request->validated();

        //dd($validados['images']);

        /*  foreach ($validados['images'] as $validado) {
            dd($validado->getClientOriginalName());
        }
        dd('caca'); */

        foreach ($validados['images'] as $file) {
            # code...
            $data = $this->sportImageService->uploadImage($file, $entry, 'public', 'sport');

            SportImage::create($data);
        }

        return to_route('sportentry.show', $entry)->with('message', 'Image(s) for (' . $entry->title . ') uploaded.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sport $entry, SportImage $image)
    {

        $this->sportImageService->deleteOneImage($image);

        //request()->headers->get('referer')
        //return to_route('sportentry.show', $entry)->with('message', 'Image ' . $image->original_filename . ' for : ' . $entry->title . ' deleted.');
        return back()->with('message', 'Image ' . $image->original_filename . ' for : ' . $entry->title . ' deleted.');
    }

    public function download(Sport $entry, SportImage $image)
    {
        return $this->sportImageService->downloadImage($image, 'attachment');
    }
}
