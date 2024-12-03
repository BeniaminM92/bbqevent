<?php

namespace App\Model;

class Event
{
//    private ?int $id;
//    private ?string $name;
//    private ?string $description;
//    private ?string $location;
//    private ?int $booked_seats;

    /**
     * @param int|null $id
     * @param string|null $name
     * @param string|null $description
     * @param string|null $location
     * @param int|null $booked_seats
     */
    public function __construct(private ?int $id = null,
                                private ?string $name = null,
                                private ?string $description = null,
                                private ?string $location = null,
                                private ?int $booked_seats = null) {

//        $this->id = $id;
//        $this->name = $name;
//        $this->description = $description;
//        $this->location = $location;
//        $this->booked_seats = $booked_seats;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string|null
     */
    public function getLocation(): ?string
    {
        return $this->location;
    }

    /**
     * @return int|null
     */
    public function getBookedSeats(): ?int
    {
        return $this->booked_seats;
    }

    public function seats(): int
    {
        return 200 - $this->booked_seats;
    }

}