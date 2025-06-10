<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_profile';

    protected $fillable = [
        'uuid',
        'profile',
        'description',
    ];

    protected $guarded = [
        'id',
    ];
    
    protected $hidden = [
        'id',
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

    public function users()
    {
        return $this->hasMany(User::class, 'uuid_profile', 'uuid');
    }

    public function permissionModules()
    {
        return $this->belongsToMany(
            PermissionModule::class,
            'tbl_profile_permission_module',  // tabela pivô
            'uuid_profile',                  // FK do Profile na pivô
            'uuid_permission_module',        // FK da PermissionModule na pivô
            'uuid',                          // chave local (Profile.uuid)
            'uuid'                           // chave relacionada (PermissionModule.uuid)
        );
    }
}
