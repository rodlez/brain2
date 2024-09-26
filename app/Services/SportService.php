<?php

namespace App\Services;

// Models
use App\Models\Sport\Sport;
use App\Models\Sport\SportTag;
use App\Models\Sport\SportCategory;

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
use App\Models\Sport\SportImage;
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
     * Inset new Entry and insert the tags in the pivot table sport_entry_tag   
     */
    public function insertEntry(array $data): Sport
    {
        $entry = Sport::create($data);
        $entry->tags()->sync($data['selectedTags']);

        return $entry;
    }

    /**
     * Update an Entry and insert the tags in the pivot table sport_entry_tag   
     */
    public function updateEntry(Sport $entry, array $data): Sport
    {
        $entry->update($data);
        $entry->tags()->sync($data['selectedTags']);

        return $entry;
    }

    /**
     *  Get all the categories orderby asc
     */
    public function getCategories(): Collection
    {
        return SportCategory::orderBy('name')->get();
    }

    /**
     *  Get all the categories orderby asc
     */
    public function getTags(): Collection
    {
        return SportTag::orderBy('name')->get();
    }

    /**
     *  Get tags for this entry
     * 
     * @param Sport $entry
     * @param string $separator Value to separate between tags (- / *) 
     */
    public function displayEntryTags(Sport $entry, string $separator): array
    {
        $tags = $entry->tags;
        $count = 0;
        $result = [];

        foreach ($tags as $tag) {
            $count++;
            if ($count == count($tags))
                $result[] = $tag->name;

            else {
                $result[] = $tag->name . ' ' . $separator . ' ';
            }
        }

        return $result;
    }

    public function getEntryTags(Sport $entry): array
    {
        $tags = [];
        foreach ($entry->tags as $tag) {
            $tags[] = $tag->pivot->sport_tag_id;
        }

        return $tags;
    }

    public function getImages(Sport $entry): Collection
    {
        return SportImage::where('sport_id', $entry->id)->get();
    }

    /**
     * Get the tag names given an array with the tag ids
     */

    public function getTagNames(array $tags): array
    {

        $tagsNames = [];
        foreach ($tags as $key => $value) {

            $tagInfo = SportTag::find($value);
            $tagsNames[] = $tagInfo->name;
        }
        return $tagsNames;
    }

    /**
     * Stats 
     */
    public function totalEntries(): int
    {
        return Sport::get()->count();
    }
    public function totalCategories(): int
    {
        return SportCategory::get()->count();
    }
    public function totalTags(): int
    {
        return SportTag::get()->count();
    }
}
