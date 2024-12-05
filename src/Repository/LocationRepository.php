<?php

namespace App\Repository;

use App\Model\Event;
use App\Model\Location;

class LocationRepository{

    private array $locations = [];


    public function __construct()
    {

        $this->locations = [
            new Location(1, 'Berlin', 'Super', 'Hauptstr 1', 50),
            new Location(2, 'Hamburg', 'Super Cool', 'Hauptstr 50', 10),
        ];
    }

    public function findAll(): array
    {
        return $this->locations;
    }

    public function findOne(int $id): ?Location {
        $locations = $this->findAll();
        foreach ($locations as $location) {
            if ($location->getId() == $id) {
                return $location;
            }
        }
        return null;
    }

    public function add(Location $location): void
    {
        $this->locations[] = $location;
    }

    public function delete(int $id): void
    {
        $this->locations = array_filter($this->locations, fn($location) => $location->getId() !== $id);
    }



}
