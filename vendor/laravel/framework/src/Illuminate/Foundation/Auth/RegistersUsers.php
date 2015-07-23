<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\CountValidator\Exception;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());
        $niceNames = array(
            'password' => 'Пароль',
            'email' => 'адрес электронной почты',
            'phone' => 'телефон'
        );

        $validator->setAttributeNames($niceNames);

        if ($validator->fails()) {
            // было изначально в фреймворке
            // вылетал эксепшн
            /*$this->throwValidationException(
                $request, $validator
            );*/

            // теперь делается редирект с возникшими ошибками на страницу регистрации
            return redirect('auth/register')->withErrors($validator->messages())->withInput($request->all());
        }

        Auth::login($this->create($request->all()));

        return redirect($this->redirectPath());
    }
}
