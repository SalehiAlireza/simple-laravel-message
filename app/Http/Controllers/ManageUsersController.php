<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Schema;

class ManageUsersController extends Controller
{
    public function loginView()
    {
        if (!Schema::hasTable('users'))
            return 'لطفا اول جدول ها رو بساز ^_^';


        return view('login');
    }

    public function login(Request $request)
    {
        $this->getValidate($request);
        // login user
        $attempt = Auth::attempt($request->all(['username','password']));
        // redirect to dashboard
        if ($attempt)
            return redirect()->route('ticket.index');
        else
            return redirect()->back();
    }

    public function logout()
    {
        auth()->logout();
        return Redirect::route('login');
    }

    private function getValidate(Request $request): void
    {
        $this->validate(
            $request,
            ['username' => 'required', 'password' => 'required']
        );
    }
}
