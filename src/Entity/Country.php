<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity()]
class Country
{
    public const UID_PREFIX = 'cou';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $uid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 3)]
    private ?string $abbreviation = null;

    #[ORM\Column(length: 255)]
    private ?string $flag = null;

    #[ManyToOne(targetEntity: Currency::class)]
    #[JoinColumn(name: 'fk_currency', referencedColumnName: 'id')]
    private Currency $currency;

    #[ORM\Column]
    private ?DateTime $createdAt = null;

    #[ORM\Column]
    private ?DateTime $updatedAt = null;

    public function setUid(string $uid): Country
    {
        $this->uid = $uid;

        return $this;
    }

    public function setName(string $name): Country
    {
        $this->name = $name;

        return $this;
    }

    public function setFlag(string $flag): Country
    {
        $this->flag = $flag;

        return $this;
    }

    public function setCurrency(Currency $currency): Country
    {
        $this->currency = $currency;

        return $this;
    }

    public function setCreatedAt(DateTime $createdAt): Country
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setUpdatedAt(DateTime $updatedAt): Country
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function setAbbreviation(string $abbreviation): Country
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }
}
