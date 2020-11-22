<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();


       //Регистрация в RF Online
       /**********  **********/
       $billing = DB::connection('sqlsrv_bil');

            $id = $request->input('name');
            $password = $request->input('password');
            $email = $request->input('email');
            $BillingType = 0; //0 нет према, 2 прем //тут
            $yCash = 0; 
            //$today = Carbon::now()->addDays(2)->addHours(3); //тут
            $today = Carbon::now()->addHours(3);

            $idconvert = DB::raw("CONVERT(VARBINARY(MAX), '". $id ."')");
            $passConvert = DB::raw("CONVERT(VARBINARY(MAX), '". $password ."')");

            DB::table('tbl_RFAccount')->insert([[
                'id' => $idconvert, 
                'password' => $passConvert,
                'accounttype' => 0, 
                'birthdate' => 0,
                'Email' => $email
            ]]);

            $billing->table('tbl_personal_billing')->insert([[
                'ID' => $idconvert,
                'BillingType' => $BillingType,
                'EndDate' => $today,
                'RemainTime' => 0
            ]]);

            // Заносим в tbl_User
            $billing->table('tbl_User')->insert([[
                'UserID' => $idconvert,
                'Cash' => $yCash
            ]]);

    /**********  **********/


        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
                    ? new JsonResponse([], 201)
                    : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
