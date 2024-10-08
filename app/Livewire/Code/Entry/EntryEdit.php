<?php

namespace App\Livewire\Code\Entry;

use Livewire\Component;

use App\Models\Code\Code;
use App\Models\Code\CodeCategory;
use App\Models\Code\CodeTag;
use Illuminate\Database\QueryException;

use App\Http\Requests\SportStoreRequest;
use Illuminate\Http\Request;

use App\Services\CodeService;

class EntryEdit extends Component
{
    public $entry;
    public $show = 0;
    public $title;
    public $urljson;
    public $info;
    public $code;
    public $type_id;
    public $category_id;
    public $selectedTags = [];

    public $inputs;

    protected $rules = [
        'title'         => 'required|min:3',
        'type_id'       => 'required',
        'category_id'   => 'required',
        'selectedTags'  => 'required',
        'info'          => 'nullable|min:3',
        'code'          => 'nullable|min:3',
        'inputs.*.url'  => 'nullable|min:3'
    ];

    protected $messages = [
        'type_id.required'      => 'The type field is required',
        'category_id.required'  => 'The category field is required',
        'selectedTags.required' => 'At least 1 tag must be selected',
        'inputs.*.url.min'      => 'The field url must have at least 3 characters',
    ];

    public function boot(
        CodeService $codeService,
    ) {
        $this->codeService = $codeService;
    }

    public function mount()
    {
        $this->title        = $this->entry->title;
        $this->type_id      = $this->entry->type_id;
        $this->category_id  = $this->entry->category_id;
        $this->urljson      = $this->entry->url;
        $this->info         = $this->entry->info;
        $this->code         = $this->entry->code;

        $this->selectedTags = $this->codeService->getEntryTags($this->entry);

        $urls = [];
        foreach (json_decode($this->urljson) as $value) {
            $urls[] = ['url' => $value];
        }

        $this->fill([
            'inputs' => collect($urls)
        ]);
    }

    public function remove($key)
    {
        $this->inputs->pull($key);
    }

    public function add()
    {
        $this->inputs->push(['url' => '']);
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
        $validated['user_id'] = $this->entry->user->id;

        $urlList = [];
        foreach ($this->inputs as $input) {
            $urlList[] = $input['url'];
        }
        // filter the empty possible url arrays and reorder the indexes        
        $urlListFiltered = array_values(array_filter($urlList));

        $validated['url'] = json_encode($urlListFiltered);

        $entry = $this->codeService->updateEntry($this->entry, $validated);

        return to_route('codeentry.show', $entry)->with('message', 'Entry (' . $entry->title . ') updated.');
    }

    public function render()
    {

        $types      = $this->codeService->getTypes();
        $categories = $this->codeService->getCategories();
        $tags       = $this->codeService->getTags();

        return view('livewire.code.entry.entry-edit', [
            'types'         => $types,
            'categories'    => $categories,
            'tags'          => $tags,
        ]);
    }
}
