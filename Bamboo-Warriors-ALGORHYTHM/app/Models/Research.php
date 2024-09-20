<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Research extends Model
{
    use HasFactory;

    protected $table = "researches";

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'author',
        'publish_date',
        'doi',
        'abstract',
        'keywords',
        'file_path',
        'user_id',
        'visibility'
    ];

    /**
     * Get the user that owns the research.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
