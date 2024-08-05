<?php

namespace App\Repository;

use App\Entity\Currency;
use App\Repository\Exception\NotFoundException;

class CurrencyRepository extends AbstractRepository
{
    public function persist(Currency $currency): void
    {
        $this->persistAndFlush($currency);
    }

    /**
     * @throws NotFoundException
     */
    public function findByCode(string $code): Currency
    {
        $query = $this->em->createQuery('SELECT c FROM \App\Entity\Currency c WHERE c.code = :code');
        $query->setParameters([
            'code' => $code,
        ]);

        $currency = $query->getOneOrNullResult();
        if ($currency === null) {
            throw new NotFoundException(sprintf('Currency: %s Not Found', $code));
        }

        return $currency;
    }
}
