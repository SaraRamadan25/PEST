<?php
uses()->group('laracasts');

it('can validate an email', function (){
    $rule  = new App\Rules\IsValidEmailAddress();

    expect($rule->passes('email','me@you.com'))->toBeTrue();
});

it('throws an exception if the value is not a string',function (){
    $rule  = new App\Rules\IsValidEmailAddress();

    $rule->passes('email',1);
})->skip(fn()=>config('app.name')=== 'foo' ,'we no longer want to test the exception')
    ->throws(InvalidArgumentException::class,'The value must be a string!');

// we can skip without conditions, just skipping,
// and we also can put conditions to determine it will be skipped or not
// SKIP_TESTS BY DEFAULT FALSE
//    ->skip('msg go here')->throws(InvalidArgumentException::class,'The value must be a string!')
