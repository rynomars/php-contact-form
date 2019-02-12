<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactUsControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Contact Us Controller Validation
     *
     * @return void
     */
    public function testContactUsControllerValidation_MissingFullName()
    {
        Mail::fake();

        $data = [
            "full_name" => '',
            "email"     => str_random(12) . '@example.com',
            "phone"     => str_random(10),
            "message"   => str_random(500),
        ];

        $response = $this->json('POST', '/contact-us', $data);
        $response->assertStatus(422)
                ->assertJson([
                    'errors' => ['full_name' => ["The full name field is required."]]
                ]);

        $this->assertDatabaseMissing('contact_us', [
            'email' => $data['email'],
            'phone' => $data['phone'],
            'message' => $data['message'],
        ]);

    }

    /**
     * Contact Us Controller Validation
     *
     * @return void
     */
    public function testContactUsControllerValidation_MissingEmail()
    {
        Mail::fake();

        $data = [
            "full_name" => str_random(50),
            "email"     => '',
            "phone"     => str_random(10),
            "message"   => str_random(500),
        ];

        $response = $this->json('POST', '/contact-us', $data);
        $response->assertStatus(422)
                 ->assertJson([
                     'errors' => ['email' => ["The email field is required."]]
                 ]);

        $this->assertDatabaseMissing('contact_us', [
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'message' => $data['message'],
        ]);

    }

    /**
     * Contact Us Controller Validation
     *
     * @return void
     */
    public function testContactUsControllerValidation_BadEmail()
    {
        Mail::fake();

        $data = [
            "full_name" => str_random(50),
            "email"     => 'bademailaddress',
            "phone"     => str_random(10),
            "message"   => str_random(500),
        ];

        $response = $this->json('POST', '/contact-us', $data);
        $response->assertStatus(422)
                 ->assertJson([
                     'errors' => ['email' => ["The email must be a valid email address."]]
                 ]);

        $this->assertDatabaseMissing('contact_us', [
            'email' => $data['email'],
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'message' => $data['message'],
        ]);

    }

    /**
     * Contact Us Controller Validation
     *
     * @return void
     */
    public function testContactUsControllerValidation_MissingMessage()
    {
        Mail::fake();

        $data = [
            "full_name" => str_random(50),
            "email"     => str_random(12) . '@example.com',
            "phone"     => str_random(10),
            "message"   => ''
        ];

        $response = $this->json('POST', '/contact-us', $data);
        $response->assertStatus(422)
                 ->assertJson([
                     'errors' => ['message' => ["The message field is required."]]
                 ]);

        $this->assertDatabaseMissing('contact_us', [
            'email' => $data['email'],
            'full_name' => $data['full_name'],
            'phone' => $data['phone'],
            'message' => $data['message'],
        ]);

    }
}
