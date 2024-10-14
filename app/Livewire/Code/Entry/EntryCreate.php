<?php

namespace App\Livewire\Code\Entry;

use Livewire\Component;

use App\Models\Code\Code;
use App\Models\Code\CodeCategory;
use App\Models\Code\CodeTag;
use Illuminate\Database\QueryException;

use App\Http\Requests\StoreCodeRequest;
use App\Models\Code\CodeType;
use Illuminate\Http\Request;

use App\Services\CodeService;

class EntryCreate extends Component
{
    public $show = 0;
    public $status;
    public $title;    
    //public $url;
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
        //'url'           => 'nullable|url',
        'info'          => 'nullable|min:3',
        'code'          => 'nullable|min:3',
        'inputs.*.url'  => 'nullable|min:3'
    ];

    protected $messages = [
        'type_id.required' => 'Select one type.',
        'category_id.required' => 'Select one category.',
        'selectedTags.required' => 'At least 1 tag must be selected.',
        'inputs.*.url.min' => 'The field url must have at least 3 characters',
    ];

    public function boot(
        CodeService $codeService,
    ) {
        $this->codeService = $codeService;
    }


    public function mount()
    {
        $this->type_id = CodeType::orderBy('name', 'asc')->pluck('id')->first();
        $this->category_id = CodeCategory::orderBy('name', 'asc')->pluck('id')->first();

        $this->fill([
            'inputs' => collect([['url' => '']])
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
        return (new CodeStoreRequest())->rules();
    } */

    public function help()
    {
        $this->show++;
    }

    public function save(Request $request)
    //public function save()
    {

        $validated = $this->validate();
        $validated['user_id'] = $request->user()->id;

        // TODO: JSONENCODE DECODE URL ARRAYS

        $urlList = [];
        foreach ($this->inputs as $input) {
            $urlList[] = $input['url'];
        }
        // filter the empty possible url arrays and reorder the indexes        
        $urlListFiltered = array_values(array_filter($urlList));

        $validated['url'] = json_encode($urlListFiltered);

        $entry = $this->codeService->insertEntry($validated);

        return to_route('codeentry.index', $entry)->with('message', 'Entry (' . $entry->title . ') created.');
    }

    public function render()
    {
        $types = $this->codeService->getTypes();
        $categories = $this->codeService->getCategories();
        $tags = $this->codeService->getTags();

        return view('livewire.code.entry.entry-create', [
            'types'         => $types,
            'categories'    => $categories,
            'tags'          => $tags
        ]);
    }
}
