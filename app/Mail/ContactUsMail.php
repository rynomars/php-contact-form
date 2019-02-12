<?php

namespace App\Mail;

use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactUs;

    /**
     * ContactUsMail constructor.
     * @param ContactUs $contactUs
     */
    public function __construct(ContactUs $contactUs)
    {
        $this->contactUs = $contactUs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact_us')
                    ->text('emails.contact_us_plain')
                    ->subject('Contact Us Submission')
                    ->with(['contactUs' => $this->contactUs]);
    }
}
