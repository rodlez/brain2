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

    // order and pagination
    public $orderColumn = "id";
    public $sortOrder = "desc";
    public $sortLink = '<i class="px-1 sorticon fa-solid fa-caret-down"></i>';
    public $perPage = 25;

    // search
    public $showSearch = 0;
    public $search = "";

    // filters
    public $showFilter = 0;
    public $pending = 2;
    public $dateFrom = '';
    public $initialDateFrom;
    public $dateTo = '';
    public $initialDateTo;
    public $cat = 0;
    public $durationFrom = 0;
    public $durationTo;
    public $initialDurationTo;
    public $distanceFrom = 0;
    public $initialDistanceTo;
    public $distanceTo;

    // multiple batch selections
    public $selections = [];

    //public $selectAll = false;


    public function updated()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->durationTo = Sport::max('duration');
        $this->initialDurationTo = Sport::max('duration');
        $this->distanceTo = Sport::max('distance');
        $this->initialDistanceTo = Sport::max('distance');
        $this->dateFrom = Sport::min('date');
        $this->initialDateFrom = Sport::min('date');
        $this->dateTo = Sport::max('date');
        $this->initialDateTo = Sport::max('date');
    }

    /*
    TODO: Make selectAll with search and filters
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selections = Sport::pluck('id')->toArray();
        } else {
            $this->selections = [];
        }
    } */

    public function activateFilter()
    {
        $this->showFilter++;
    }

    public function activateSearch()
    {
        $this->showSearch++;
    }

    public function clearFilters()
    {
        $this->pending = 2;
        $this->dateFrom = Sport::min('date');
        $this->dateTo = Sport::max('date');
        $this->cat = 0;
        $this->durationFrom = 0;
        $this->durationTo = Sport::max('duration');
        $this->distanceFrom = 0;
        $this->distanceTo = Sport::max('distance');
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
            $entry = Sport::find($selection);
            $entry->delete();
        }

        return to_route('sportentry.index')->with('message', 'entries: deleted.');
    }

    public function resetAll()
    {
        $this->clearFilters();
        $this->clearSearch();
        $this->bulkClear();
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
        $found = 0;

        // get only the categories that have at least one entry
        //$categories = SportCategory::orderBy('name', 'asc')->get();
        $categories = Sport::select(
            'sport_categories.id as id',
            'sport_categories.name as name'
        )
            ->join('sport_categories', 'sport_entries.category_id', '=', 'sport_categories.id')->distinct('category_id')->orderBy('name', 'asc')->get()->toArray();

        // Main Selection, Join tables sport_entries and sport_categories
        $entries = Sport::select(
            'sport_entries.id as id',
            'sport_categories.name as category_name',
            'sport_entries.title as title',
            'sport_entries.user_id as user_id',
            'sport_entries.status as status',
            'sport_entries.location as location',
            'sport_entries.duration as duration',
            'sport_entries.distance as distance',
            'sport_entries.url as url',
            'sport_entries.info as info',
            'sport_entries.date as date',
            'sport_entries.created_at as created_at',
        )
            ->join('sport_categories', 'sport_entries.category_id', '=', 'sport_categories.id')
            ->orderby($this->orderColumn, $this->sortOrder);

        // status filter
        if ($this->pending != 2) {
            $entries = $entries->where('status', '=', $this->pending);
        }

        // interval date
        if (isset($this->dateFrom)) {
            if ($this->dateFrom <= $this->dateTo) {
                $entries = $entries->whereBetween('date', [$this->dateFrom, $this->dateTo]);
            }
        }

        // category filter
        if ($this->cat != 0) {
            $entries = $entries->where('sport_categories.name', '=', $this->cat);
        }

        // interval duration    
        if ($this->durationFrom <= $this->durationTo) {
            $entries = $entries->whereBetween('duration', [$this->durationFrom, $this->durationTo]);
        }

        // interval distance    
        if ($this->distanceFrom <= $this->distanceTo) {
            $entries = $entries->whereBetween('distance', [$this->distanceFrom, $this->distanceTo]);
        }

        // Search
        if (!empty($this->search)) {
            // search by id or name
            //$entries->orWhere('id', "like", "%" . $this->search . "%");
            //->orWhere('location', "like", "%" . $this->search . "%")
            $entries = $entries->where('title', "like", "%" . $this->search . "%");
            $found = $entries->count();
        }

        // total values for display stats
        $stats = $entries;
        //dd($stats->count());
        $totalEntries = $entries->count();
        $totalDuration = $entries->sum('duration');
        $totalDistance = $entries->sum('distance');
        /*
        $differentCategories = $stats->distinct('sport_categories.id')->count();
        $differentLocations = $stats->distinct('location')->count();
        $differentDates = $stats->distinct('date')->count(); */

        //dd($entries->count());
        $entries = $entries->paginate($this->perPage);



        return view('livewire.sport.entry.entry-pagination', [
            'entries' => $entries,
            'found' => $found,
            'total' => $totalEntries,
            /* 'differentLocations' => $differentLocations,
            'differentCategories' => $differentCategories,
            'differentDates' => $differentDates,*/
            'totalDuration' => $totalDuration,
            'totalDistance' => $totalDistance,
            'column' => $this->orderColumn,
            'categories' => $categories,
        ]);
    }
}
