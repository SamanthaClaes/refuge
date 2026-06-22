<?php

namespace App\Enums;

enum AnimalStatus: string
{
        case AVAILABLE = 'disponible';
        case PENDING = 'en attente';

        case INCARE = 'en soins';

        case ADOPTED = 'adopté(e)';

}
