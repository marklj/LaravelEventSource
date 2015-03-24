<?php namespace App\EventSource;

use App\Events\Event;
use Rhumsaa\Uuid\Uuid;

class EventStoreRepository {


    public function save(Event $event)
    {
        \DB::table('event_store')->insert([
            'uuid' => Uuid::uuid4(),
            'type' => $event->getType(),
            'event' => serialize($event),
            'created_at' => microtime(true)
        ]);
    }

}