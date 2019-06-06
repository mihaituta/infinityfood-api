<?php

namespace App;

use GenTux\Jwt\JwtPayloadInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;


/**
 * Class User
 *
 * @package App
 */
class User extends Model implements JwtPayloadInterface
{
    use Authenticatable;

    /** @var int */
    const ROLE_ADMIN = 'Admin';

    /** @var int */
    const ROLE_STAFF = 'Staff';

    /** @var int */
    const ROLE_USER = 'User';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'forgot_code'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $visible = [
        'id',
        'name',
        'email',
        'role_id'
    ];

    /**
     * Jwt payload
     *
     * @return array
     */
    public function getPayload()
    {
        return [
            'id' => $this->id,
            'exp' => time() + 7200,
            'context' => [
                'email' => $this->email
            ]
        ];
    }

    /**
     * User assigned tasks
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks()
    {
        return $this->hasMany('App/Task', 'assign', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function store()
    {
        return $this->hasOne('App/Store');
    }
}
