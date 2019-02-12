<?php

namespace Tests\Feature;

use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubmitContactUsTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSubmitContactUs()
    {
        Mail::fake();

        $data = [
            "full_name" => str_random(50),
            "email"     => str_random(12) . '@example.com',
            "phone"     => str_random(10),
            "message"   => str_random(500),
        ];

        $response = $this->json('POST','/contact-us', $data);
        $response->assertStatus(200);

        $this->assertDatabaseHas('contact_us', [
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message'],
        ]);

        /*
         * Assert an Email was sent to guy-smiley@example.com
         */
        Mail::assertSent(ContactUsMail::class, function ($mail) {
            return $mail->hasTo('guy-smiley@example.com');
        });

        /*
         * Assert the correct data was sent in the mail
         */
        Mail::assertSent(ContactUsMail::class, function ($mail) use ($data) {
            return  $mail->contactUs->full_name === $data['full_name'] &&
                    $mail->contactUs->email === $data['email'] &&
                    $mail->contactUs->phone === $data['phone'] &&
                    $mail->contactUs->message === $data['message'];
        });
    }
}
