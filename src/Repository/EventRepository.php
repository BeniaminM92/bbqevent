<?php

namespace App\Repository;

use App\Model\Event;

class EventRepository
{
    public function findAll(): array
    {
        $party1 = new Event(1, 'Techno', 'Super Techno Party', 'Alex', 50 );
        $party2 = new Event(2, 'Rock', 'Tolle Rock Party', 'ABC', 190 );
        $party3 = new Event(3, 'Hip Hop', 'Mäßige Hip Hop Party', 'Hop', 200 );

        return [$party1, $party2, $party3];
    }

    public function find(int $id): ?Event
    {
        $events = $this->findAll();
        foreach ($events as $event)
        {
            if ($event->getId() == $id)
            {
                return $event;
            }
        }
        return null;
    }

}