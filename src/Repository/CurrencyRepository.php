<?php

namespace App\Repository;

use App\Entity\Currency;

class CurrencyRepository extends AbstractRepository
{
    public function persist(Currency $currency): void
    {
        $this->em->persist($currency);

        if (!$this->isFlushDisabled) {
            $this->em->flush();
        }
    }

    public function flush(): void
    {
        $this->em->flush();
    }
}
