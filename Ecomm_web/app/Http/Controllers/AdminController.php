<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.login');
    }

    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        $result=Admin::where(['email'=>$email,'password'=>$password])->get();

        if(isset($result[0]->id)){
            $request->session()->put('ADMIN_LOGIN',true);
            $request->session()->put('ADMIN_ID',$result['0']->id);
            return redirect('admin\dashboard');
        }
        else{
            $result->session()->flash('error','Please enter the valid data for the field.');
            return redirect('admin');
        }
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
  
}
