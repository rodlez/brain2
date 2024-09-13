<?php

namespace App\Livewire\Sport\Entry;

use Livewire\Component;

use App\Models\Sport\Sport;
use App\Models\Sport\SportCategory;
use App\Models\Sport\SportTag;
use Illuminate\Database\QueryException;

class EntryTest extends Component
{
    public $selectedUsers = [];



    public function mount() {}


    public function render()
    {

        $tags = SportTag::orderBy('name')->get();

        $plucked = SportTag::orderBy('name')->get()->pluck('name', 'id');


        /* var_export($plucked[62]);
        echo "<br><br><br>";
        var_export($plucked);
        die(); */

        $a = [
            ['name' => 'a', 'id' => '1'],
            ['name' => 'b', 'id' => '2'],
            ['name' => 'c', 'id' => '3']
        ];
        $b = array(
            array('name' => 'd', 'id' => '4'),
            array('name' => 'e', 'id' => '5'),
            array('name' => 'f', 'id' => '6')
        );
        $c = [
            ['label' => 'g', 'value' => '7'],
            ['label' => 'h', 'value' => '8']
        ];
        $newArray = [];

        //var_export($a);
        //var_export($b);

        foreach ($c as $key => $value) {
            array_push($b, $value);
        }
        //array_push($b, $c);

        foreach ($plucked as $key => $value) {
            array_push($newArray, ['label' => $key, 'value' => $value]);
        }

        $tagjson = '[{"label":"a","value":"1"},{"label":"b","value":"2"},{"label":"c","value":"3"},{"label":"d","value":"4"}]';


        //var_dump($tagjson);
        //dd(json_encode($newArray));
        /* var_export($b);
        var_export($plucked);
        dd($newArray);
        die(); */


        return view('livewire.sport.entry.entry-test', [
            'tags'          => json_encode($newArray),
            'tags2'         => $newArray,
            'tagjson'       => $tagjson,
            'testini'       => 'mire usted'
        ]);
    }
}
