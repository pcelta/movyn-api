<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

#[ORM\Entity()]
class Currency
{
    public const UID_PREFIX = 'cur';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $uid = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 3)]
    private ?string $code = null;

    #[ORM\Column(length: 3)]
    private ?string $symbol = null;

    #[ORM\Column(length: 10)]
    private ?string $nativeSymbol = null;

    #[OneToMany(targetEntity: Country::class, mappedBy: 'currency')]
    private Collection $countries;

    #[ORM\Column]
    private ?DateTime $createdAt = null;

    #[ORM\Column]
    private ?DateTime $updatedAt = null;

    public function setUid($uid): Currency
    {
        $this->uid = $uid;

        return $this;
    }

    public function setName($name): Currency
    {
        $this->name = $name;

        return $this;
    }

    public function setCode($code): Currency
    {
        $this->code = $code;

        return $this;
    }

    public function setSymbol($symbol): Currency
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function setNativeSymbol($nativeSymbol): Currency
    {
        $this->nativeSymbol = $nativeSymbol;

        return $this;
    }

    public function setCreatedAt($createdAt): Currency
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function setUpdatedAt($updatedAt): Currency
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUid(): string
    {
        return $this->uid;
    }
}
