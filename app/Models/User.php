<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

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

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class, 'uuid_profile', 'uuid');
    }
}
