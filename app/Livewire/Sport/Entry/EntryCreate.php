<?php

namespace App\Livewire\Sport\Entry;

use Livewire\Component;

use App\Models\Sport\Sport;
use App\Models\Sport\SportCategory;

use Illuminate\Database\QueryException;

class EntryCreate extends Component
{
    public $inputs;
    public $show = 0;
    public $title;
    public $location;
    public $duration;
    public $distance;
    public $info;
    public $category_id;

    protected $rules = [
        'title' => 'required|min:3',
        'category_id' => 'required',
        'location' => 'required|min:3',
        'duration' => 'required',
        'distance' => 'required',
        'info' => 'required|min:3'
    ];

    protected $messages = [
        'title.required' => 'The field title is required',
        'title.min' => 'The field title must have at least 3 characters',
        'location.required' => 'The field location is required',
        'location.min' => 'The field location must have at least 3 characters',
        'duration.required' => 'The field duration is required',
        'duration.min' => 'The field duration must have at least 3 characters',
        'distance.required' => 'The field distance is required',
        'distance.min' => 'The field distance must have at least 3 characters',
        'info.required' => 'The field info is required',
        'info.min' => 'The field info must have at least 3 characters',
    ];

    public function mount()
    {
        $this->fill([
            'inputs' => collect([['name' => '']])
        ]);
    }

    public function help()
    {
        $this->show++;
    }

    public function save()
    {
        $validated = $this->validate();

        dd($validated, 'validated');

        /* foreach ($this->inputs as $input) {

            try {
                SportCategory::create(['name' => $input['name']]);
            } catch (QueryException $exception) {

                $errorInfo = $exception->errorInfo;
                // Return the response to the client..
                return to_route('sportcategory.index')->with('message', 'Error(' . $errorInfo[0] . ') creating the category (' . $input['name'] . ')');
            }
        }

        $message = "";
        $this->inputs->count() === 1 ? $message = ' new Category created' : $message = ' new Categories created';

        return to_route('sportentry.index')->with('message', $this->inputs->count() . $message); 
        */
    }

    public function render()
    {
        $categories = SportCategory::orderBy('name')->get();

        return view('livewire.sport.entry.entry-create', [
            'categories'    => $categories
        ]);
    }
}
