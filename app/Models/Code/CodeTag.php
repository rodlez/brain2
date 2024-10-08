<?php

namespace App\Models\Code;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeTag extends Model
{
    use HasFactory;

    // protected array with the keys that are valid, when create method get the data array will have access to this keys
    protected $fillable = [
        'name'
    ];

    /**
     * Get the sport entries associated with the category.
     */
    public function codes()
    {
        return $this->belongsToMany(
            Code::class,
            table: 'code_entry_tag',
            relatedPivotKey: 'code_entry_id'
        )->withTimestamps();
    }
}
