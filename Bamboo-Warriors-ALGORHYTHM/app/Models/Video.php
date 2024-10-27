<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = "videos";
    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'creator',
        'publication_date',
        'description',
        'file_path',
        'user_id',
        'cover_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Relationship to User
    }
}