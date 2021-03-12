<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Restaurant;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'avatar_path' => ['string'],
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

       // $this->guard()->login($user);
    //this commented to avoid register user being auto logged in

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath())->with('status', 'Account Created!');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // dd($data);
        // return User::create([
        //     'firstName' => $data['firstName'],
        //     'lastName' => $data['lastName'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        //     // 'avatar_path' => da vedere ??????????
        // ]);
        
        //Creo il nuovo Ristoratore
        $newUser = new User();

        $newUser->fill($data);
        $newUser->password = Hash::make($data['password']);
        $newUser->avatar_path = 'images/user.png';
        //Salvo nel db il ristoratore
        $newUser->save();
        
        //Creo il nuovo ristorante
        $newRestaurant = new Restaurant();

        $newRestaurant->fill($data);
        $newRestaurant->user_id = $newUser->id;
        $newRestaurant->slug = Str::slug($newRestaurant->business_name);
        //Salvo nel db il ristorante
        $newRestaurant->save();

        return redirect()->route('login');
        
    }
}
