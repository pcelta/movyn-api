<?php

namespace App\Repository;

use Doctrine\ORM\EntityManagerInterface;

class AbstractRepository
{
    protected bool $isFlushDisabled = false;

    public function __construct(protected EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function setIsFlushDisabled(bool $isFlushDisabled): void
    {
        $this->isFlushDisabled = $isFlushDisabled;
    }
}
