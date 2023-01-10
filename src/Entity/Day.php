<?php

namespace App\Entity;

use App\Model\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity]
#[ORM\Table(name: 'days')]
class Day extends Entity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private ?int $seed = null;

    #[ORM\OneToMany(mappedBy: 'day', targetEntity: Game::class)]
    private Collection $games;

    #[ORM\ManyToOne(targetEntity: Championship::class, inversedBy: 'days')]
    #[Ignore]
    private ?Championship $championship = null;

    public function __construct(?array $payload = null)
    {
        $this->games = new ArrayCollection();
        parent::__construct($payload);
    }

    public function getGames(): ?Collection
    {
        return $this->games;
    }

    public function addGame(Game $team)
    {
        if (!$this->games->contains($team)) {
            $this->games->add($team);
            $team->setDay($this);
        }
    }

    public function removeGame(Game $team)
    {
        if ($this->games->contains($team)) {
            $this->games->remove($team);
            $team->setDay(null);
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
     * @return Day
     */
    public function setId(?int $id): Day
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getSeed(): ?int
    {
        return $this->seed;
    }

    /**
     * @param int|null $seed
     * @return Day
     */
    public function setSeed(?int $seed): Day
    {
        $this->seed = $seed;
        return $this;
    }

    /**
     * @return Championship|null
     */
    public function getChampionship(): ?Championship
    {
        return $this->championship;
    }

    /**
     * @param Championship|null $championship
     * @return Day
     */
    public function setChampionship(?Championship $championship): Day
    {
        $this->championship = $championship;
        return $this;
    }
}