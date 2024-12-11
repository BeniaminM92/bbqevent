<?php

namespace App\Entity;

enum EventTypeEnum :string
{
    case Party = 'Party';
    case Konzert = 'Konzert';
    case Parteitag = 'Parteitag';
    case Theater = 'Theater';


}
