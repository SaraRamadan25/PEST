<?php
use App\Models\Contact;

uses(\Illuminate\Foundation\Testing\WithFaker::class);
it('can store a contact' ,function(){

    login()->post('/contacts',[
        'first_name' => $this->faker->firstName,
        'last_name' => $this->faker->lastName,
        'email' => $this->faker->email,
        'phone' => $this->faker->e164PhoneNumber,
        'address' => '1 Test Street',
        'city' => 'Testerfield',
        'region' => 'Derbyshire',
        'country' => $this->faker->randomElement(['us', 'ca']),
        'postal_code' => $this->faker->postcode,
    ])
    ->assertRedirect('/contacts')
        ->assertSessionHas('success', 'Contact created.');

    expect(Contact::latest()->first())
        ->first_name->toBeString()->not->toBeEmpty()
        ->last_name->toBeString()->not->toBeEmpty()
        ->email->toBeString()->toContain('@')
        ->phone->toBeString->toContain('+')
        ->region->toBe('Derbyshire')
        ->country->toBeIn(['us', 'ca']);
});
