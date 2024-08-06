<?php

namespace AppTest\Repository;

use App\Entity\Country;
use App\Repository\CountryRepository;
use App\Repository\Exception\NotFoundException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CountryReporitoryTest extends TestCase
{
    public function testFindByNameShouldThrowNotFoundExceptionWhenNotFound()
    {
        $name = 'invalid-name';

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("Country: $name Not Found");

        $query = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $query->expects($this->once())
            ->method('setParameters')
            ->with(['name' => $name]);

        $query->expects($this->once())
            ->method('getOneOrNullResult')
            ->willReturn(null);

        /** @var EntityManager | MockObject $em */
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $em->expects($this->once())
            ->method('createQuery')
            ->with('SELECT c FROM \App\Entity\Country c WHERE c.name = :name')
            ->willReturn($query);

        $repository = new CountryRepository($em);
        $repository->findByName($name);
    }

    public function testFindByNameShouldReturnCurrencyWhenFound(): void
    {
        $name = 'valid-name';

        $query = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $query->expects($this->once())
            ->method('setParameters')
            ->with(['name' => $name]);

        $query->expects($this->once())
            ->method('getOneOrNullResult')
            ->willReturn(new Country());

        /** @var EntityManager | MockObject $em */
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $em->expects($this->once())
            ->method('createQuery')
            ->with('SELECT c FROM \App\Entity\Country c WHERE c.name = :name')
            ->willReturn($query);

        $repository = new CountryRepository($em);
        $repository->findByName($name);
    }
}
