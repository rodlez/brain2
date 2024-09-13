<?php

namespace App\Services;

// Models
use App\Models\Sport\SportTag;
use App\Models\Sport\Sport;
// Request
use Illuminate\Http\Request;
use App\Http\Requests\SportStoreRequest;
use File;
// Collection
use Illuminate\Database\Eloquent\Collection;
//Exceptions
use Exception;
use Illuminate\Database\QueryException;
use App\Exceptions\CustomException;
// Log
use Illuminate\Support\Facades\Log;
use stdClass;


class SportService
{

    public function test()
    {
        dd('test injection SportService');
    }
    /**
     * Append to the FormData the pending boolean value and the user_id to prepare the data for DB Insertion   
     */
    public function appendUserIdToFormData(Request $request, array $formData): array
    {
        $formData['user_id'] = $request->user()->id;

        return $formData;
    }

    /**
     * Inset new Note and insert the tags in the intermediate table note_tag   
     */
    public function insertEntry(array $data): Sport
    {
        $entry = Sport::create($data);
        // insert selectedTags in the pivot table sport_entry_tag
        $entry->tags()->sync($data['selectedTags']);

        return $entry;
    }
}
