<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MyTestMail;
use App\Jobs\SendEmail;

class MailController extends Controller
{   
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