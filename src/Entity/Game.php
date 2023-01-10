<?php

namespace App\Entity;

use App\Model\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity]
#[ORM\Table(name: 'games')]
class Game extends Entity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Team::class, cascade: ["persist"], inversedBy: 'games')]
    private ?Team $homeTeam = null;

    #[ORM\ManyToOne(targetEntity: Team::class, cascade: ["persist"], inversedBy: 'games')]
    private ?Team $outsiderTeam = null;

    #[ORM\Column(type: 'integer')]
    private ?int $homeScore = null;

    #[ORM\Column(type: 'integer')]
    private ?int $outsiderScore = null;

    #[ORM\ManyToOne(targetEntity: Day::class, inversedBy: 'games')]
    #[Ignore]
    private ?Day $day = null;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Game
     */
    public function setId(?int $id): Game
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Team|null
     */
    public function getHomeTeam(): ?Team
    {
        return $this->homeTeam;
    }

    /**
     * @param Team|null $homeTeam
     * @return Game
     */
    public function setHomeTeam(?Team $homeTeam): Game
    {
        $this->homeTeam = $homeTeam;
        return $this;
    }

    /**
     * @return Team|null
     */
    public function getOutsiderTeam(): ?Team
    {
        return $this->outsiderTeam;
    }

    /**
     * @param Team|null $outsiderTeam
     * @return Game
     */
    public function setOutsiderTeam(?Team $outsiderTeam): Game
    {
        $this->outsiderTeam = $outsiderTeam;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getHomeScore(): ?int
    {
        return $this->homeScore;
    }

    /**
     * @param int|null $homeScore
     * @return Game
     */
    public function setHomeScore(?int $homeScore): Game
    {
        $this->homeScore = $homeScore;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getOutsiderScore(): ?int
    {
        return $this->outsiderScore;
    }

    /**
     * @param int|null $outsiderScore
     * @return Game
     */
    public function setOutsiderScore(?int $outsiderScore): Game
    {
        $this->outsiderScore = $outsiderScore;
        return $this;
    }

    /**
     * @return Day|null
     */
    public function getDay(): ?Day
    {
        return $this->day;
    }

    /**
     * @param Day|null $day
     * @return Game
     */
    public function setDay(?Day $day): Game
    {
        $this->day = $day;
        return $this;
    }
}