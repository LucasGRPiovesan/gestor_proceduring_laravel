<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermissionModule extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_permission_module';

    protected $fillable = [
        'uuid',
        'uuid_permission',
        'uuid_module',
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
        'uuid_permission' => 'string',
        'uuid_module' => 'string',
    ];

    public function modules()
    {
        return $this->belongsTo(Module::class, 'uuid_module', 'uuid');
    }

    public function permissions()
    {
        return $this->belongsTo(Permission::class, 'uuid_permission', 'uuid');
    }

    public function profiles()
    {
        return $this->belongsToMany(
            Profile::class,
            'tbl_profile_permission_module',
            'uuid_permission_module',
            'uuid_profile',
            'uuid',
            'uuid'
        );
    }
}
