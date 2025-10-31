<?php
namespace App\Http\Controllers\clogin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class loginController extends Controller{
    public function mostrarLogin() {
        return view('login.login'); 
    }

    public function validarLogin(Request $request){
        $request->validate([
            'usuario' => 'required',
            'contrasenha' => 'required'
        ]);
        $usuario = $request->input('usuario');
        $contrasenha = $request->input('contrasenha');
        
        $admin = Admin::where('rut_admin', $usuario)->first();

        if ($admin && Hash::check($contrasenha, $admin->password)) {
            Auth::login($admin);
            $request->session()->regenerate();
            return redirect()->route('dashboard.inicio');
        } else {
            return redirect()->route('login.mostrar')
                 ->with('error', 'Usuario o contraseña incorrectos');
        }
    }
}