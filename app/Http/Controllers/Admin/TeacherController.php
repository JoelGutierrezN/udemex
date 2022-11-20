<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class TeacherController extends Controller
{
    public function index()
    {
        $users = User::latest()->where('role', 2)->has('informacionAcademica')->get();

        return view('admin-modules.teachers.index', compact('users'));
    }
}
