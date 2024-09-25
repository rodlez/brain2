<?php

namespace App\Livewire\Sport\Tag;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Sport\SportTag;

class TagPagination extends Component
{

    use WithPagination;

    //protected $paginationTheme = "bootstrap";
    public $orderColumn = "id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="px-1 sorticon fa-solid fa-caret-down"></i>';

    // search
    public $showSearch = 0;
    public $search = "";

    public $perPage = 25;

    public $selections = [];

    public function updated()
    {
        $this->resetPage();
    }

    public function activateSearch()
    {
        $this->showSearch++;
    }

    public function clearSearch()
    {
        $this->search = '';
    }

    public function bulkClear()
    {
        $this->selections = [];
    }

    public function bulkDelete()
    {
        foreach ($this->selections as $selection) {
            $tag = SportTag::find($selection);
            $tag->delete();
        }

        return to_route('sporttag.index')->with('message', 'tags: deleted.');
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

        $tags = SportTag::orderby($this->orderColumn, $this->sortOrder)->select('*');
        //->where('name', "like", "%" . 'al' . "%");

        if (!empty($this->search)) {

            // search by id or name
            //$tags->orWhere('id', "like", "%" . $this->search . "%");
            $found = $tags->where('name', "like", "%" . $this->search . "%")->count();
        }

        $total = $tags->count();

        $tags = $tags->paginate($this->perPage);

        return view('livewire.sport.tag.tag-pagination', [
            'tags'      => $tags,
            'found'     => $found,
            'column'    => $this->orderColumn,
            'total'     => $total
        ]);
    }
}
