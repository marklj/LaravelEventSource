<?php namespace App\EventSource;

use Illuminate\Contracts\Events\Dispatcher;

abstract class BaseAggregate {

    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var array
     */
    protected $events = [];

    protected function __construct(Dispatcher $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @return array
     */
    public function getEvents()
    {
        return $this->events;
    }

    public static function regenerateFrom($instance, Dispatcher $dispatcher, array $events)
    {
        foreach($events as $event)
        {
            $instance->recordThat($event);
        }
        return $instance;
    }

    protected function apply($event)
    {
        $reflect = new \ReflectionClass($event);
        $method = "apply" . $reflect->getShortName();
        $this->$method($event);
    }

    protected function dispatch($event)
    {
        $this->dispatcher->fire($event);
    }

    /**
     * @param $event
     */
    public function recordThat($event)
    {
        $this->events[] = $event;
        $this->apply($event);
    }

}