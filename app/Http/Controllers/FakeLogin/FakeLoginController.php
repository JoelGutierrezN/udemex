<?php

namespace App\Http\Controllers\FakeLogin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

class FakeLoginController extends Controller
{

    public function fakelogin (){
    $user_id = 2;
    $user = new Usuario(["id_usuario" => 177,"nombre"=> "Joel", "email_udemex" => "joelgut1998@outlook.com", "rol"=> 2 ]);
    Auth::login($user);

    return redirect()->route('teacher.index');
}
}
