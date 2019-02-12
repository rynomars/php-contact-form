<?php

namespace Tests\Feature;

use App\Models\ContactUs;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactUsModelTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testContactUsModal()
    {
        /** @var ContactUs $contactUs */
        $contactUs = factory(ContactUs::class)->create();
        $this->assertDatabaseHas('contact_us', [
            "full_name" => $contactUs->full_name,
            "email"     => $contactUs->email,
            "phone"     => $contactUs->phone,
            "message"   => $contactUs->message,
        ]);
    }
}
