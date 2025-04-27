<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'profile',
        'description',
    ];
    
    protected $primaryKey = 'id';
    public $incrementing = true;

    protected $keyType = 'int';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'uuid' => 'string',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'uuid_profile', 'uuid');
    }
}
