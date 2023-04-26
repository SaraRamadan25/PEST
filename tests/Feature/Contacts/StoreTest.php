<?php
use App\Models\Contact;
use function Pest\Faker\faker;

// when we use the above plugin we don't need to use trait ( WithFaker )

it('can store a contact' ,function(){

    login()->post('/contacts',[
        'first_name' => faker()->firstName,
        'last_name' => faker()->lastName,
        'email' => faker()->email,
        'phone' => faker()->e164PhoneNumber,
        'address' => '1 Test Street',
        'city' => 'Testerfield',
        'region' => 'Derbyshire',
        'country' => faker()->randomElement(['us', 'ca']),
        'postal_code' => faker()->postcode,
    ])
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
});
