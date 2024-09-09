<?php

namespace App\Models\Sport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    use HasFactory;

    // protected array with the keys that are valid, when create method get the data array will have access to this keys
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'date',
        'duration',
        'location',
        'info'
    ];

    /**
     * Get the user associated with the Sport.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category associated with the Sport.
     */
    public function category()
    {
        return $this->belongsTo(SportCategory::class);
    }
}
