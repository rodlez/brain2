<?php

namespace App\Livewire\Sport\Category;

use Livewire\Component;

use App\Models\Sport\SportCategory;

use Illuminate\Database\QueryException;

class CategoryCreate extends Component
{
    public $inputs;
    public $show = 0;

    protected $rules = [
        'inputs.*.name' => 'required|min:3|unique:sport_categories,name|distinct'
    ];

    protected $messages = [
        'inputs.*.name.required' => 'The field name is required',
        'inputs.*.name.min' => 'The field name must have at least 3 characters',
        'inputs.*.name.unique' => 'The field name is already created',
        'inputs.*.name.distinct' => 'The field name has a duplicate'
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

    public function remove($key)
    {
        $this->inputs->pull($key);
    }

    public function add()
    {
        $this->inputs->push(['name' => '']);
    }

    public function save()
    {
        $this->validate();

        foreach ($this->inputs as $input) {

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

        return to_route('sportcategory.index')->with('message', $this->inputs->count() . $message);
    }

    public function render()
    {
        return view('livewire.sport.category.category-create');
    }
}
