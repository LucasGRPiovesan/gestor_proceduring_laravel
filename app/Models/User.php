<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'tbl_user';

    protected $fillable = [
        'uuid_profile',
        'name',
        'email',
        'password'
    ];

    protected $guarded = [
        'id',
    ];
    
    protected $hidden = [
        'id',
        'password',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'uuid' => 'string',
    ];

    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $keyType = 'int';

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'uuid_profile', 'uuid');
    }
}
