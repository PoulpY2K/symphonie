<?php

namespace App\Entity;

use App\Model\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'championships')]
class Championship extends Entity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    #[ORM\Column(type: 'string', length: 8)]
    private ?string $code = null;

    #[ORM\OneToMany(mappedBy: 'championship', targetEntity: Team::class)]
    private Collection $teams;

    #[ORM\OneToMany(mappedBy: 'championship', targetEntity: Day::class)]
    private Collection $days;

    public function __construct(?array $payload = null)
    {
        $this->teams = new ArrayCollection();
        $this->days = new ArrayCollection();
        parent::__construct($payload);
    }

    public function getTeams(): ?Collection
    {
        return $this->teams;
    }

    public function addTeam(Team $team)
    {
        if (!$this->teams->contains($team)) {
            $this->teams->add($team);
            $team->setChampionship($this);
        }
    }

    public function removeTeam(Team $team)
    {
        if ($this->teams->contains($team)) {
            $this->teams->remove($team);
            $team->setChampionship(null);
        }
    }

    public function getDays(): ?Collection
    {
        return $this->days;
    }

    public function addDay(Day $day)
    {
        if (!$this->days->contains($day)) {
            $this->days->add($day);
            $day->setChampionship($this);
        }
    }

    public function removeDay(Day $day)
    {
        if ($this->days->contains($day)) {
            $this->days->remove($day);
            $day->setChampionship(null);
        }
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Championship
     */
    public function setId(?int $id): Championship
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Championship
     */
    public function setName(?string $name): Championship
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param string|null $code
     * @return Championship
     */
    public function setCode(?string $code): Championship
    {
        $this->code = $code;
        return $this;
    }
}