<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\Client as Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home', ['client' => Client::where('user_id', Auth::user()->id)->first()]);
    }

    /**
     * Show the application dashboard.
     * @param  \Illuminate\Http\Request  $request 
     *
     * @return \Illuminate\Http\Response
     */
    public function modifyClient(Request $request)
    {
        $input = $request->validate([
            'firstName' => 'required|max:255',
            'middleName' => 'required|max:255',
            'lastName' => 'required|max:255',
            'street' => 'required',
            'housnumber' => 'required|numeric',
            'postCode' => 'required',
            'gender' => 'required'
        ]);
        if ( Client::where('user_id', Auth::user()->id)->first() ) {
            $client = Client::where('user_id', Auth::user()->id)->first();
        } else {
            $client = new Client;
            $client->user_id = Auth::user()->id;
        }

        $client->name         = $input['firstName'];
        $client->middle_name  = $input['middleName'];
        $client->last_name    = $input['lastName'];
        $client->street       = $input['street'];
        $client->house_number = $input['housnumber'];
        $client->post_code    = $input['postCode'];
        $client->gender       = $input['gender'];

        $client->save();

        return redirect('home');
    }

}
