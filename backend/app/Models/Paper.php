<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    use HasFactory;

    protected $table = 'papers';

    protected $fillable = [
        'conference_id',
        'author_name',
        'author_title',
        'email',
        'phone',
        'whatsapp',
        'country',
        'nationality',
        'password',
        'file_path',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    /**
     * Get the conference that owns the paper.
     */
    // مو اكيد 
    // public function conference()
    // {
    //     return $this->belongsTo(Conference::class);
    // }
}
