<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug',
        'status',
        'visibility',
        'type',
        'sku',
        'regular_price',
        'description',
        'summary',
        'sale_price',
        'taxable',
        'weight',
        'length',
        'width',
        'height',
        'purchase_note',
        'meta_title',
        'meta_description',
        'sell_button_text',
        'virtual',
        'downloadable',
        'sale_start_date',
        'sale_end_date',
        'publish_at',
        'deleted_at',
        'suspended_at',
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
