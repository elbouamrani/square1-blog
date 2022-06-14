<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'publication_date',
    ];

    protected $dates = [
        'publication_date'
    ];

    public function author(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'author_id');
    } 
}
