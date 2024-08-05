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

    protected function persistAndFlush($entity): void
    {
        $this->em->persist($entity);

        if (!$this->isFlushDisabled) {
            $this->em->flush();
        }
    }

    public function flush(): void
    {
        $this->em->flush();
    }
}
