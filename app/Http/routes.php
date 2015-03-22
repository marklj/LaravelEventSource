<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function()
{
    $faker = Faker\Factory::create();
    foreach(range(1, 20) as $index)
    {
        $dispatcher = App::make('Illuminate\Contracts\Events\Dispatcher');

        $customer = \App\Customer::register(
            $dispatcher,
            $faker->firstName, $faker->lastName, $faker->email
        );
        $customer->updateProfile("name", $faker->firstName);
    }
//    $new_customer = \App\Customer::regenerateFrom($dispatcher, $customer->getEvents());

    $all = App::make('App\Projectors\CustomerRepository')->all();
    dd($all);
});
