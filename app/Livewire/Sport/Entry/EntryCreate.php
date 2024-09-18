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
    public $inputs;
    public $show = 0;
    public $title;
    public $date;
    public $location;
    public $duration;
    public $distance;
    public $info;
    public $category_id;
    public $selectedTags = [];



    protected $rules = [
        'title' => 'required|min:3',
        'category_id' => 'required',
        'selectedTags' => 'required',
        'date' => 'required',
        'location' => 'required|min:3',
        'duration' => 'required',
        'distance' => 'nullable',
        'info' => 'nullable|min:3'
    ];

    protected $messages = [
        'category_id.required' => 'The category field is required',
        'selectedTags.required' => 'At least 1 tag must be selected',
    ];

    private SomeService $someService;
    private OneMoreService $oneMoreService;

    public function boot(
        SportService $sportService,
    ) {
        $this->sportService = $sportService;
    }

    public function mount()
    {
        $this->fill([
            'inputs' => collect([['name' => '']])
        ]);
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
