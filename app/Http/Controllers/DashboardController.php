<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function viewLogin(){
        return view('Dashboard.login',[
            'title' => 'Login | Dashboard Lofinz',
            'css' => 'login.css'
        ]);
    }

    public function actionLogin(Request $request){
        $request->validate([
            'username' => 'required|min:2|max:250',
            'password' => 'required',
        ]);
        
        if(Auth::guard('administrator')->attempt(['username' => $request->username, 'password' => $request->password])){
            $request->session()->regenerate();
            return redirect('/dashboard/beranda');
        }
        return back()->withInput()->with([
            'loginInvalid' => 'Username / Password salah!',
        ]);
    }

    public function adminLogout(){

    }

    public function viewBeranda(){
        return view('Dashboard.beranda', [
            'title' => 'Beranda | Dashboard Lofinz',
            'css' => "beranda.css",
        ]);
    }
}
