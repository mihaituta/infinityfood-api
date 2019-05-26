<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /** @var string */
    const TYPE_STARTER = 'Starter';

    /** @var string */
    const TYPE_MAIN = 'Main';

    /** @var string */
    const TYPE_DESSERT = 'Dessert';

    /** @var string */
    const TYPE_FASTFOOD = 'Fastfood';

    /** @var string */
    const TYPE_PIZZA = 'Pizza';

    /** @var string */
    const TYPE_DRINK = 'Drink';

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
