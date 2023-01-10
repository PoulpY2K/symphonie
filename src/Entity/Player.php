<?php

namespace App\Entity;

use App\Model\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity]
#[ORM\Table(name: 'players')]
class Player extends Entity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    #[ORM\Column(type: 'string')]
    private ?string $position = null;

    #[ORM\Column(type: 'string')]
    private ?string $club = null;

    #[ORM\Column(type: 'integer')]
    private ?int $age = null;

    #[ORM\ManyToOne(targetEntity: Team::class, inversedBy: 'players')]
    #[Ignore]
    private ?Team $team = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Player
     */
    public function setId(?int $id): Player
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
     * @return Player
     */
    public function setName(?string $name): Player
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * @param string|null $position
     * @return Player
     */
    public function setPosition(?string $position): Player
    {
        $this->position = $position;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getClub(): ?string
    {
        return $this->club;
    }

    /**
     * @param string|null $club
     * @return Player
     */
    public function setClub(?string $club): Player
    {
        $this->club = $club;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getAge(): ?int
    {
        return $this->age;
    }

    /**
     * @param int|null $age
     * @return Player
     */
    public function setAge(?int $age): Player
    {
        $this->age = $age;
        return $this;
    }

    /**
     * @return Team|null
     */
    public function getTeam(): ?Team
    {
        return $this->team;
    }

    /**
     * @param Team|null $team
     * @return Player
     */
    public function setTeam(?Team $team): Player
    {
        $this->team = $team;
        return $this;
    }
}