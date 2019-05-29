<?php

namespace AppBundle\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * @ORM\Entity
 *
 * @Table(name="near_earth_object",
 *    uniqueConstraints={
 *        @UniqueConstraint(name="reference_unique",
 *            columns={"reference"})
 *    }
 * ) */
class NearEarthObject
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="reference", type="integer")
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="speed_per_second", type="decimal")
     */
    private $speedPerSecond;

    /**
     * @var bool
     *
     * @ORM\Column(name="hazardous", type="boolean")
     */
    private $hazardous;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getReference(): int
    {
        return $this->reference;
    }

    /**
     * @param int $reference
     */
    public function setReference(int $reference)
    {
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getSpeedPerSecond(): float
    {
        return $this->speedPerSecond;
    }

    /**
     * @param float $speedPerSecond
     */
    public function setSpeedPerSecond(float $speedPerSecond)
    {
        $this->speedPerSecond = $speedPerSecond;
    }

    /**
     * @return bool
     */
    public function isHazardous(): bool
    {
        return $this->hazardous;
    }

    /**
     * @param bool $hazardous
     */
    public function setHazardous(bool $hazardous)
    {
        $this->hazardous = $hazardous;
    }

    /**
     * @return DateTime
     */
    public function getDate(): DateTime
    {
        return $this->date;
    }

    /**
     * @param DateTime $date
     */
    public function setDate(DateTime $date)
    {
        $this->date = $date;
    }
}