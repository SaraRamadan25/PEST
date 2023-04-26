<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Models\User;
use Illuminate\Support\Str;
use PHPUnit\Framework\ExpectationFailedException;

uses(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/
expect()->extend('toBePhoneNumber',function (){

    expect($this->value)->toBeString()->toStartWith('+');
    if (strlen($this->value) < 6) {
        throw new ExpectationFailedException('Phone Number Must be at Least 6 chars');
    }
    // this output here will be an OBJ , so we want to convert it to a string.
    if (! is_numeric(Str::of($this->value)->after('+')->remove([' ', '-'])->__toString())) {
        throw new ExpectationFailedException('Phone numbers must be numeric.');
    }


});



/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function login($user = null)
{
    // this word "test" dependent on the testCase we Use
    return test()->actingAs($user ?? User::factory()->create());
}
