<?php

namespace App\Livewire\Sport\Entry;

use Livewire\Component;

use App\Models\Sport\Sport;
use App\Models\Sport\SportCategory;
use App\Models\Sport\SportTag;
use Illuminate\Database\QueryException;

use App\Http\Requests\SportStoreRequest;
use Illuminate\Http\Request;

use App\Services\SportService;

class EntryEdit extends Component
{
    public $entry;
    public $show = 0;
    public $title;
    public $status;
    public $date;
    public $location;
    public $duration;
    public $distance;
    public $url;
    public $info;
    public $category_id;
    public $selectedTags = [];


    protected $rules = [
        'title'         => 'required|min:3',
        'status'        => 'nullable',
        'category_id'   => 'required',
        'selectedTags'  => 'required',
        'date'          => 'required|after:01/01/2024',
        'location'      => 'required|min:2',
        'duration'      => 'required|gte:5',
        'distance'      => 'nullable|gte:0',
        'url'           => 'nullable|url',
        'info'          => 'nullable|min:3'
    ];

    protected $messages = [
        'category_id.required' => 'The category field is required',
        'selectedTags.required' => 'At least 1 tag must be selected',
    ];

    public function boot(
        SportService $sportService,
    ) {
        $this->sportService = $sportService;
    }

    public function mount()
    {
        $this->title = $this->entry->title;
        $this->status = $this->entry->status;
        $this->date = $this->entry->date;
        $this->category_id = $this->entry->category_id;
        $this->location = $this->entry->location;
        $this->duration = $this->entry->duration;
        $this->distance = $this->entry->distance;
        $this->url = $this->entry->url;
        $this->info = $this->entry->info;

        $this->selectedTags = $this->sportService->getEntryTags($this->entry);
    }

    /* protected function rules(): array
    {
        return (new SportStoreRequest())->rules();
    } */

    public function help()
    {
        $this->show++;
    }

    public function save()
    {

        $validated = $this->validate();
        $validated['distance'] != "" ?: $validated['distance'] = 0;
        $validated['user_id'] = $this->entry->user->id;

        $entry = $this->sportService->updateEntry($this->entry, $validated);

        return to_route('sportentry.show', $entry)->with('message', 'Entry (' . $entry->title . ') updated.');
    }

    public function render()
    {

        $categories = $this->sportService->getCategories();
        $tags = $this->sportService->getTags();

        return view('livewire.sport.entry.entry-edit', [
            'categories'    => $categories,
            'tags'          => $tags,
        ]);
    }
}
