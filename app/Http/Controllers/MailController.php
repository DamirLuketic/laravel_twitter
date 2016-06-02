<?php

namespace App\Http\Controllers;

use App\Http\Requests\MailRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Mail;



class MailController extends Controller
{
    public function create()
    {
        return view('mail.create');
    }

    public function send(MailRequest $request)
    {

        $data =
            [
                'title'     => $request->title,
                'body'       => $request->body
            ];

        // don't forget to impot 'Mail' class

        // -> mail index -> file /
        Mail::send('mail/index', $data, function($message)
        {
            $message->to('luketic.damir@gmail.com', 'Like Damir')->subject('Test');
        });

        session()->flash('mail_send', 'Your e-mail has been send.');

        return redirect('/');

    }
}
