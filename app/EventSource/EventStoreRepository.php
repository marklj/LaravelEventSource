<?php namespace App\EventSource;

class EventStoreRepository {


    public function save($event)
    {
        \DB::table('event_store')->insert([
            'event' => serialize($event),
            'created_at' => microtime(true)
        ]);
    }

}