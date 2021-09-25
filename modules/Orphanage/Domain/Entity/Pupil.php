<?php

namespace Orphanage\Domain\Entity;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    protected $fillable = [
        'name',
        'birthday',
        'orphanage_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'orphanage_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'birthday' => 'datetime:d.m.Y',
    ];

    protected $appends = [
        'user',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserAttribute()
    {
        return $this->user()->get()->first();
    }
}
