<?php

namespace App\Repository;

use App\Entity\Country;
use App\Repository\Exception\NotFoundException;

class CountryRepository extends AbstractRepository
{
    public function persist(Country $country): void
    {
        $this->persistAndFlush($country);
    }

    /**
     * @throws NotFoundException
     */
    public function findByName(string $name): Country
    {
        $query = $this->em->createQuery('SELECT c FROM \App\Entity\Country c WHERE c.name = :name');
        $query->setParameters([
            'name' => $name,
        ]);

        $currency = $query->getOneOrNullResult();
        if ($currency === null) {
            throw new NotFoundException(sprintf('Country: %s Not Found', $name));
        }

        return $currency;
    }
}
