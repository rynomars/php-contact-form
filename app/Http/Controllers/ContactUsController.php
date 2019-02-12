<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsMail;
use App\Models\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{

    public function submit(Request $request)
    {
        /*
         * Validate the request
         */
        $request->validate([
            'full_name' => 'required|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|max:255',
            'message'   => 'required'
        ]);

        /*
         * Save contact form to database.
         */

        $contactUs = new ContactUs();
        $contactUs->full_name = $request->get('full_name');
        $contactUs->email = $request->get('email');
        $contactUs->phone = $request->get('phone');
        $contactUs->message = $request->get('message');
        $contactUs->save();

        /*
         * Send email to guy smiley
         */
        Mail::to(config('contact-us.send-to'))->send(new ContactUsMail($contactUs));

        return response()->json(['success' => true]);
    }
}
