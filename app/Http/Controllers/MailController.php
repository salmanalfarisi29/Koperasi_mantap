<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    
    public function index(){

	$details = [
    'title' => 'Koperasi-Mantap Proudly Present',
    'body' => 'Hai dah beres ya'
    ];
   
    Mail::to('mfa33plk@gmail.com')->send(new \App\Mail\MyTestMail($details));
    Mail::to('muhamad.farid.tif21@polban.ac.id')->send(new \App\Mail\MyTestMail($details));
    Mail::to('zahratul.mardiyah.tif21@polban.ac.id')->send(new \App\Mail\MyTestMail($details));
    Mail::to('salman.alfarisi.tif21@polban.ac.id')->send(new \App\Mail\MyTestMail($details));

    dd("Email sedang terkirim.");

	}
}