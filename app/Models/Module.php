<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_module';

    protected $fillable = [
        'uuid',
        'uuid_module',
        'module',
        'description'
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
        'uuid_module' => 'string',
    ];

    public function modules()
    {
        return $this->hasMany(Module::class, 'uuid_module', 'uuid');
    }

    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'tbl_permission_module',  // nome da tabela pivô
            'uuid_module',            // chave estrangeira da model atual (Module)
            'uuid_permission',        // chave estrangeira da outra model (Permission)
            'uuid',                   // chave local (da tabela Module)
            'uuid'                    // chave local (da tabela Permission)
        );
    }
}
