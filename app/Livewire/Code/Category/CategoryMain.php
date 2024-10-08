<?php

namespace App\Livewire\Code\Category;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Code\CodeCategory;

class CategoryMain extends Component
{

    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="fa-solid fa-caret-down"></i>';
    public $search = "";
    public $perPage = 25;

    public $selections = [];

    public function updated()
    {
        $this->resetPage();
    }

    public function clearSearch()
    {
        $this->search = "";
    }

    public function bulkClear()
    {
        $this->selections = [];
    }

    public function bulkDelete()
    {
        foreach ($this->selections as $selection) {
            $category = CodeCategory::find($selection);
            $category->delete();
        }

        return to_route('codecategory.index')->with('message', 'Categories successfully deleted.');
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

        $this->sortLink = '<i class="fa-solid fa-caret-' . $caretOrder . '"></i>';
        $this->orderColumn = $columnName;
    }
    public function render()
    {
        $found = 0;

        $categories = CodeCategory::orderby($this->orderColumn, $this->sortOrder)->select('*');

        if (!empty($this->search)) {

            $found = $categories->where('name', "like", "%" . $this->search . "%")->count();
        }

        $total = $categories->count();

        $categories = $categories->paginate($this->perPage);

        return view('livewire.code.category.category-main', [
            'categories' => $categories,
            'found' => $found,
            'column' => $this->orderColumn,
            'total'     => $total
        ]);
    }
}
