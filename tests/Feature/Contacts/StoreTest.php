<?php
use App\Models\Contact;

// when we use the above plugin we don't need to use trait ( WithFaker )

// if we want to pass a parameter to our test closure, we can use datasets at the end of our code

it('can store a contact' ,function($mail){

    login()->post('/contacts', [...[
        'first_name' => fake()->firstName,
        'last_name' => fake()->lastName,
        'email' => $mail,
        'phone' => fake()->e164PhoneNumber,
        'address' => '1 Test Street',
        'city' => 'Testerfield',
        'region' => 'Derbyshire',
        'country' => fake()->randomElement(['us', 'ca']),
        'postal_code' => fake()->postcode,
    ]])
    ->assertRedirect('/contacts')
        ->assertSessionHas('success', 'Contact created.');

    // this called higher older expectations
    expect(Contact::latest()->first())
        ->first_name->toBeString()->not->toBeEmpty()
        ->last_name->toBeString()->not->toBeEmpty()
        ->email->toBeString()->toContain('@')
        ->phone->toBePhoneNumber
        ->region->toBe('Derbyshire')
        ->country->toBeIn(['us', 'ca']);
})->with('Valid Emails');
