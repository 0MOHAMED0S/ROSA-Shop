<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfessionalEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class ContactController extends Controller
{
    public function index()
    {
        return view('User.ContactUs');
    }
    public function send(ContactRequest $request)
    {
        $data = $request->validated();
        $data['subject'] = "Contact Us Message";
    
        try {
            $user = Auth::user();
    
            if (!$user || !$user->email) {
                return back()->with('error', 'User not authenticated or missing email.');
            }
    
            Mail::to($user->email)->send(
                new ProfessionalEmail($data['subject'], $data['message'])
            );
    
            return back()->with('success', 'Email has been sent successfully.');
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to send email. Please try again later.');
        }
    }
}
