<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Redirect;
use Socialite;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
  */

  use AuthenticatesAndRegistersUsers, ThrottlesLogins;

  /**
   * Where to redirect users after login / registration.
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Create a new authentication controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
  }

    public function redirectToProvider($provider = 'google')
    {
        return Socialite::with($provider)->redirect();
    }

    public function handleProviderCallback($provider = 'google')
    {
        try {
            $user = Socialite::with($provider)->user();
        } catch (Exception $e) {
            return Redirect::to('auth/'.$provider);
        }

        $authUser = $this->findOrCreateUser($user, $provider);

        Auth::login($authUser, true);

        return Redirect::to('/');

    // $user->token;
    }

    private function findOrCreateUser($user, $provider)
    {
        if ($authUser = User::where($provider.'_id', $user->id)->first()) {
            return $authUser;
        }

        $provider = ($provider.'_id');

        $u = new User();
        $u->name = $user->name;
        $u->email = $user->email;
        $u->$provider = $user->id;
        $u->avatar = $user->avatar;
        $u->save();

        return $u;
    }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   *
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
      return Validator::make($data, [
      'name'     => 'required|max:255',
      'email'    => 'required|email|max:255|unique:users',
      'password' => 'required|min:6|confirmed',
    ]);
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   *
   * @return User
   */
  protected function create(array $data)
  {
      return User::create([
      'name'     => $data['name'],
      'email'    => $data['email'],
      'password' => bcrypt($data['password']),
    ]);
  }
}
