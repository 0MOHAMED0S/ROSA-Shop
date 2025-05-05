<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendEmailRequest;
use Illuminate\Http\Request;
use App\Jobs\SendEmailJob;
use App\Models\User;

class MessageController extends Controller
{
    public function index()
    {
        return view('Admin.SendEmail.emails');
    }

    public function send(SendEmailRequest $request)
    {
        $users = User::all();
        foreach ($users as $user) {
            SendEmailJob::dispatch($user->email, $request->subject, $request->message)->delay(now()->addSeconds(2));
        }
        return back()->with('success', 'Emails are being sent in background.');
    }
}
