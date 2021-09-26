<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Profile\Domain\Entity\Role;
use Tag\Domain\Entity\Tag;

class User extends Authenticatable implements \JsonSerializable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'first_name',
        'second_name',
        'last_name',
        'birthday',
        'phone',
        'created_at',
        'updated_at',
        'pivot',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role_id',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'role',
        'tags',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getRoleAttribute()
    {
        return $this->role()->get()->first();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTagsAttribute()
    {
        return $this->tags()->get();
    }
}
