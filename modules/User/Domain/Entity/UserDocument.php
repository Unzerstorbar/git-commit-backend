<?php

namespace User\Domain\Entity;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    protected $table = 'user_documents';

    protected $fillable = [
        'id',
        'user_id',
        'type',
        'series',
        'number',
        'issued',
        'issued_date',
        'department_code',
    ];

    protected $hidden = [
        'user_id',
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
