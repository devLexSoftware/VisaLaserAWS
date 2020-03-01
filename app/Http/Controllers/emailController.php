<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class emailController extends Controller
{
    //
    public function contact(){
        $subject = "Asunto del correo";
        $for = "eliotdagon@gmail.com";
        Mail::send('email',"Otros", function($msj) use($subject,$for){
            $msj->from("desarrollolexsoftwawre@gmail.com","Lex software");
            $msj->subject($subject);
            $msj->to($for);
        });
        return redirect()->back();
    }
}
