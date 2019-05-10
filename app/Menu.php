<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /** @var string */
    const TYPE_STARTER = 'starter';

    /** @var string */
    const TYPE_MAIN = 'main';

    /** @var string */
    const TYPE_DESSERT = 'dessert';

    /** @var string */
    const TYPE_FASTFOOD = 'fastfood';

    /** @var string */
    const TYPE_PIZZA = 'pizza';

    /** @var string */
    const TYPE_DRINK = 'drink';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'type',
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
