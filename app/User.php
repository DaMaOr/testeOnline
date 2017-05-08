<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'roles',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
      'roles' => 'array'
    ];

    const ADMIN = 'Admin';
    const STUDENT = 'Student';
    const PROFESOR = 'Profesor';

    const ROLES = [self::ADMIN, self::STUDENT, self::PROFESOR];

    const REGISTERROLES = [self::STUDENT, self::PROFESOR];
}
