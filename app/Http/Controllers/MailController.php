<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;
use App\Jobs\SendEmail;

class MailController extends Controller
{
    
    // public function index(){

	// $details = [
    // 'title' => 'Koperasi-Mantap Proudly Present',
    // 'body' => 'Hai dah beres ya'
    // ];
   
    // Mail::to('mfa33plk@gmail.com')->send(new \App\Mail\MyTestMail($details));
    // Mail::to('muhamad.farid.tif21@polban.ac.id')->send(new \App\Mail\MyTestMail($details));
    // Mail::to('zahratul.mardiyah.tif21@polban.ac.id')->send(new \App\Mail\MyTestMail($details));
    // Mail::to('salman.alfarisi.tif21@polban.ac.id')->send(new \App\Mail\MyTestMail($details));

    // dd("Email sedang terkirim.");

	// }
    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */ 
    public function enqueue(Request $request)
    {
        $details = ['email' => '1mfaridakbar@gmail.com'];
        SendEmail::dispatch($details);
    }
}