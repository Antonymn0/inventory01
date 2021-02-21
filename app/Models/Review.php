<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    

            /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'approved_by',
        'title',
        'slug',
        'description',
        'rating',
        'published_at',
        'deleted_at',
        'suspended_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
       //
    ];
}
