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

class EntryCreate extends Component
{
    public $show = 0;
    public $status;
    public $title;
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
        'category_id.required' => 'Select one category.',
        'selectedTags.required' => 'At least 1 tag must be selected.',
    ];

    public function boot(
        SportService $sportService,
    ) {
        $this->sportService = $sportService;
    }

    public function mount()
    {
        $this->date = date('Y-m-d');
        $this->status = false;
        $this->distance = 0;
        $this->category_id = SportCategory::orderBy('name', 'asc')->pluck('id')->first();
    }

    /* protected function rules(): array
    {
        return (new SportStoreRequest())->rules();
    } */

    public function help()
    {
        $this->show++;
    }

    public function save(Request $request)
    {

        $validated = $this->validate();
        $validated['distance'] != "" ?: $validated['distance'] = 0;
        $validated['user_id'] = $request->user()->id;

        $entry = $this->sportService->insertEntry($validated);

        return to_route('sportentry.index', $entry)->with('message', 'Entry (' . $entry->title . ') created.');
    }

    public function render()
    {
        $categories = $this->sportService->getCategories();
        $tags = $this->sportService->getTags();

        return view('livewire.sport.entry.entry-create', [
            'categories'    => $categories,
            'tags'         => $tags
        ]);
    }
}
