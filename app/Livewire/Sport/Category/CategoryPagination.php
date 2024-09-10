<?php

namespace App\Livewire\Sport\Category;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Sport\SportCategory;

class CategoryPagination extends Component
{

    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="px-1 sorticon fa-solid fa-caret-down"></i>';
    public $search = "";
    public $perPage = 25;

    public $selections = [];

    public function updated()
    {
        $this->resetPage();
    }

    public function bulkDelete()
    {
        foreach ($this->selections as $selection) {
            $category = SportCategory::find($selection);
            $category->delete();
        }

        return to_route('sportcategory.index')->with('message', 'Categories: deleted.');
    }

    public function sorting($columnName = "")
    {
        $caretOrder = "up";
        if ($this->sortOrder == 'asc') {
            $this->sortOrder = 'desc';
            $caretOrder = 'down';
        } else {
            $this->sortOrder = 'asc';
            $caretOrder = 'up';
        }

        $this->sortLink = '<i class="px-1 sorticon fa-solid fa-caret-' . $caretOrder . '"></i>';
        $this->orderColumn = $columnName;
    }
    public function render()
    {
        //echo "search -> " . $this->search;
        $found = 0;

        $categories = SportCategory::orderby($this->orderColumn, $this->sortOrder)->select('*');
        //->where('name', "like", "%" . 'al' . "%");

        if (!empty($this->search)) {

            // search by id or name
            //$categories->orWhere('id', "like", "%" . $this->search . "%");
            $found = $categories->where('name', "like", "%" . $this->search . "%")->count();
        }

        $categories = $categories->paginate($this->perPage);

        return view('livewire.sport.category.category-pagination', [
            'categories' => $categories,
            'found' => $found,
            'column' => $this->orderColumn
        ]);
    }
}
