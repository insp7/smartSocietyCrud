<?php

namespace App\Http\Controllers;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function compare(Request $request){
        $userValidatedData=$request->validate([
            /*DATA FOR USERS TABLE*/
            'file1' => 'required|image|mimes:jpg,jpeg,png',
            'file2' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $attachments = $request->file();


        foreach ($attachments as $name => $attachment){

            error_log($name);
            // The file name of the attachment
            $fileName = 'img'.'_'.time().'.'.$attachment->getClientOriginalExtension();
            // exact path on the current machine
            $destinationPath = public_path('/storage/attachments/');
            // Moving the image
            $attachment->move($destinationPath, $fileName);

        }
    }


}
