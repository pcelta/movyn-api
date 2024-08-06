<?php

namespace AppTest\Repository;

use App\Entity\Currency;
use App\Repository\CurrencyRepository;
use App\Repository\Exception\NotFoundException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CurrencyRepositoryTest extends TestCase
{
    public function testFindCodeShouldThrowNotFoundExceptionWhenNotFound()
    {
        $code = 'invalid-code';

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage("Currency: $code Not Found");

        $query = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $query->expects($this->once())
            ->method('setParameters')
            ->with(['code' => $code]);

        $query->expects($this->once())
            ->method('getOneOrNullResult')
            ->willReturn(null);

        /** @var EntityManager | MockObject $em */
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $em->expects($this->once())
            ->method('createQuery')
            ->with('SELECT c FROM \App\Entity\Currency c WHERE c.code = :code')
            ->willReturn($query);

        $repository = new CurrencyRepository($em);
        $repository->findByCode($code);
    }

    public function testFindCodeShouldReturnCurrencyWhenFound()
    {
        $code = 'valid-code';

        $query = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $query->expects($this->once())
            ->method('setParameters')
            ->with(['code' => $code]);

        $query->expects($this->once())
            ->method('getOneOrNullResult')
            ->willReturn(new Currency());

        /** @var EntityManager | MockObject $em */
        $em = $this->getMockBuilder(EntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $em->expects($this->once())
            ->method('createQuery')
            ->with('SELECT c FROM \App\Entity\Currency c WHERE c.code = :code')
            ->willReturn($query);

        $repository = new CurrencyRepository($em);
        $repository->findByCode($code);
    }
}
