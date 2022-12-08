<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminIndexController extends Controller
{
    public function __invoke()
    {
        // $num_teachers = User::where('role', 2)->has('informacionAcademica')->count();
        return view('admin-modules.welcome');
    }
}
