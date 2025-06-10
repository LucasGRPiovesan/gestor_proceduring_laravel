<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_permission';

    protected $fillable = [
        'uuid',
        'permission',
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
    ];

    public function modules()
    {
        return $this->belongsToMany(
            Module::class,
            'tbl_permission_module',  // nome da tabela pivô
            'uuid_permission',        // chave estrangeira da model atual (Permission)
            'uuid_module',            // chave estrangeira da outra model (Module)
            'uuid',                   // chave local (da tabela Permission)
            'uuid'                    // chave local (da tabela Module)
        );
    }
}
