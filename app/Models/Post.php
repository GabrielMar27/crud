<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'id',
        'title',
        'image',
        'description',
        'create_at',
        'updated_at',
        'imageFolder',
        'wroteBy',
    ];
    public function writer():HasOne
    {
        $this->hasOne(User::class, 'id','wroteBy') ;
        return $this->hasOne(User::class, 'id','wroteBy');
    }
}
