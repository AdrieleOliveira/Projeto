<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Repositories\Repository;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $model;

    protected $redirectTo = RouteServiceProvider::PRODUCT;

    public function __construct(User $user)
    {
        $this->middleware('guest')->except('logout');

        $this->model = new Repository($user);
    }

    public function login(Request $request){

        $params = [
            'email' => $request->get('email-login'),
            'password' => $request->get('password-login')
        ];

        $result = $this->model->where($params, 'name');

        if($result->count() == 0){
            return redirect()->back()->withInput()->with('error', 'Usuário ou senha incorretos!');
        } else {
            $result = $result->first();
            Auth::login($result, true);

            return redirect()->route('produto-inicial');
        }
    }
}
