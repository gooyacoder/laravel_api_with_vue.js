<?php

namespace Tests\Feature;

use App\Contact;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Throwable;

class ContactsTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_contact_can_be_added(){
        $this->withoutExceptionHandling();
        $this->post('/api/contacts', [
            'name' => 'Test Name',
            'email' => 'test@email.com',
            'birthday' => '05/14/1988',
            'company' => 'ABC String',
        ]);
        $contact = Contact::first();
        $this->assertEquals('Test Name', $contact->name);
        $this->assertEquals('test@email.com', $contact->email);
        $this->assertEquals('05/14/1988', $contact->birthday);
        $this->assertEquals('ABC String', $contact->company);
    }
    /** @test */
    public function a_name_is_required(){
        //$this->withoutExceptionHandling();
        $response = $this->post('/api/contacts', [
            'email' => 'test@email.com',
            'birthday' => '05/14/1988',
            'company' => 'ABC String',
        ]);

        $response->assertSessionHasErrors('name');
        $this->assertCount(0, Contact::all());

    }

    /** @test */
    public function an_email_is_required(){
        //$this->withoutExceptionHandling();
        $response = $this->post('/api/contacts', [
            'name' => 'Test Name',
            'birthday' => '05/14/1988',
            'company' => 'ABC String',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());

    }
}
