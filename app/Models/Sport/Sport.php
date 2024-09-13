<?php

namespace App\Models\Sport;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Sport extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sport_entries';

    // protected array with the keys that are valid, when create method get the data array will have access to this keys
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'date',
        'location',
        'duration',
        'distance',
        'info'
    ];

    /**
     * Get the user associated with the Sport.
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            foreignKey: 'user_id'
        );
    }

    /**
     * Get the category associated with the Sport.
     */
    public function category()
    {
        return $this->belongsTo(
            SportCategory::class,
            foreignKey: 'category_id'
        );
    }

    /**
     * Get the tags associated with the Sport.
     */
    public function tags()
    {
        return $this->belongsToMany(
            SportTag::class,
            table: 'sport_entry_tag',
            foreignPivotKey: 'sport_entry_id'
        )->withTimestamps();
    }
}
