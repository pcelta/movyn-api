<?php

namespace App\Repository;

use App\Entity\Country;

class CountryRepository extends AbstractRepository
{
    public function persist(Country $country): void
    {
        $this->persistAndFlush($country);
    }
}
