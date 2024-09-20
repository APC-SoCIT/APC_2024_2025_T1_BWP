<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = "articles";

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'author',
        'publication_date',
        'abstract',
        'keywords',
        'file_path',
        'user_id',
        'visibility', // Added visibility field
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
