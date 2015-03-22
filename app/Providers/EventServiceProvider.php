<?php namespace App\Providers;

use App\Events\CustomerRegistered;
use App\Projectors\CustomerProjector;
use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider {

	/**
	 * The event handler mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [

	];

	/**
	 * Register any other events for your application.
	 *
	 * @param  \Illuminate\Contracts\Events\Dispatcher  $events
	 * @return void
	 */
	public function boot(DispatcherContract $events)
	{
        parent::boot($events);
        \Event::listen('App\Events\Customer\*', function($event)
        {
            \App::make('App\Projectors\CustomerProjector')->handle($event);
            \App::make('App\EventSource\EventStoreRepository')->save($event);
        });

    }

}
