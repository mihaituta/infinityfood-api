<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @var int */
    const STATUS_IN_PROGRESS = 0;

    /** @var int */
    const STATUS_DONE = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'totalPrice',
        'menus',
        'name',
        'phone',
        'city',
        'address',
        'houseNr',
        'floor',
        'apartment',
        'information',
        'store_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Store');
    }
}
