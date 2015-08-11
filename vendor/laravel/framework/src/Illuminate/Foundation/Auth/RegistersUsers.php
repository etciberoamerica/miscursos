<?php

namespace Illuminate\Foundation\Auth;

use misCursos\Model\Institution;
use misCursos\Model\Country;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data = [];
        $data += ['' => utf8_encode('Selecciona Institución')];
        $data += Institution::getListIns()->toArray();

        //dd(Country::getCountry());
        $dataIns =[];
        $dataIns +=['' => utf8_encode('Selecciona País')];
        $dataIns += Country::getCountry()->toArray();


/*dd($data);
        exit();*/
        //return view('auth/register')


        return view('auth.register')
            ->with('data',$data)
            ->with('dataIns',$dataIns);
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

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->messages());
            /*
            $this->throwValidationException(
                $request, $validator
            );*/

        }

        Auth::login($this->create($request->all()));

        return redirect($this->redirectPath());
    }
}
