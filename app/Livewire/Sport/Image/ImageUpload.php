<?php

namespace App\Livewire\Sport\Image;

use Livewire\Component;
use Livewire\WithFileUploads;

use App\Models\Sport\SportImage;
use App\Services\SportImageService;

class ImageUpload extends Component
{
    use WithFileUploads;

    public $entry;
    public $images = [];

    protected $rules = [
        'images' => 'required|array',
        'images.*' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
    ];

    protected $messages = [
        'images.required' => 'Select at least one file to upload',
        'images.*.required' => 'Select at least one file to upload',
        'images.*.mimes' => 'At least one file is not one of the allowed formats: PDF, JPG, JPEG or PNG',
    ];

    public function boot(
        SportImageService $sportImageService,
    ) {
        $this->sportImageService = $sportImageService;
    }

    public function deleteImage($position)
    {
        array_splice($this->images, $position, 1);
    }


    public function save()
    {

        $this->validate();

        foreach ($this->images as $file) {
            $data = $this->sportImageService->uploadImage($file, $this->entry, 'public', 'sport');

            SportImage::create($data);
        }

        return to_route('sportentry.show', $this->entry)->with('message', 'Image(s) for (' . $this->entry->title . ') uploaded.');
    }
}
