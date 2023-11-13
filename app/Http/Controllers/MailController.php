<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Mail;
use App\Mail\MailNotify;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from Chinku',
            'body' => 'This is test mail using smtp',
        ];

        Mail::to('Chinkhuu14@gmail.com')->send(new MailNotify($mailData));

        dd('Email send success');
    }


}
