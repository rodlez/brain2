<?php

namespace App\Livewire\Sport\Entry;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Sport\Sport;
use App\Models\Sport\SportCategory;

class EntryPagination extends Component
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
            $entry = Sport::find($selection);
            $entry->delete();
        }

        return to_route('sportentry.index')->with('message', 'entries: deleted.');
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

        $categories = SportCategory::orderBy('name', 'asc')->get();

        //$entries = Sport::orderby($this->orderColumn, $this->sortOrder)->select('*');
        //->where('name', "like", "%" . 'al' . "%");
        // JOIN TO order category by name
        $entries = Sport::select(
            'sport_entries.id as id',
            'sport_categories.name as category_name',
            'sport_entries.title as title',
            'sport_entries.user_id as user_id',
            'sport_entries.location as location',
            'sport_entries.duration as duration',
            'sport_entries.distance as distance',
            'sport_entries.info as info',
            'sport_entries.date as date',
            'sport_entries.created_at as created_at',
        )
            ->join('sport_categories', 'sport_entries.category_id', '=', 'sport_categories.id')
            ->orderby($this->orderColumn, $this->sortOrder);

        if (!empty($this->search)) {

            // search by id or name
            //$entries->orWhere('id', "like", "%" . $this->search . "%");
            $found = $entries->where('title', "like", "%" . $this->search . "%")->count();
        }

        $entries = $entries->paginate($this->perPage);

        return view('livewire.sport.entry.entry-pagination', [
            'entries' => $entries,
            'found' => $found,
            'column' => $this->orderColumn
        ]);
    }
}
