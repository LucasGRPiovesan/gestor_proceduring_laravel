<?php

namespace App\Http\Controllers;

use App\Models\Module;
use Illuminate\Http\Request;

class ModuleController extends Controller
{

    public function list()
    {
        return Module::select(
            'uuid', 
            'uuid_module', 
            'module', 
            'description'
        )->where('deleted_at', null)->get();
    }

    public function permissionsByModule() 
    {
        $modules = Module::select(
            'uuid', 
            'uuid_module', 
            'module', 
            'description'
        )->with(
            ['permissions' => function($query) {
                $query->select(
                    'tbl_permission.uuid', 
                    'tbl_permission.permission', 
                    'tbl_permission.description'
                );
            }]
        )->get();
        
        return response()->json($modules);   
    }
}
