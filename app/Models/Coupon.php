<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                'name',
                'slug',
                'code',
                'description',
                'discount_rate',
                'start_date',
                'end_date',
                'usage_times',
                'status',
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
