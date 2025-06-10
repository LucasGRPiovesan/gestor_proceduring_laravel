<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilePermissionModule extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_profile_permission_module';

    protected $fillable = [
        'uuid',
        'uuid_profile',
        'uuid_permission_module',
        'status',
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
        'uuid_profile' => 'string',
        'uuid_permission_module' => 'string',
    ];

    public function profiles()
    {
        return $this->belongsTo(Profile::class, 'uuid_profile', 'uuid');
    }

    public function permissionsModules()
    {
        return $this->belongsTo(PermissionModule::class, 'uuid_permission_module', 'uuid');
    }
}
