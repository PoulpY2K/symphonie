<?php

namespace App\Entity;

use App\Model\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity]
#[ORM\Table(name: 'teams')]
class Team extends Entity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private ?string $name = null;

    #[ORM\Column(type: 'string')]
    private ?string $stadium = null;

    #[ORM\Column(type: 'string')]
    private ?string $coach = null;


    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'teams')]
    #[Ignore]
    private ?User $user = null;

    #[ORM\ManyToOne(targetEntity: Championship::class, inversedBy: 'teams')]
    #[Ignore]
    private ?Championship $championship = null;

    #[ORM\OneToMany(mappedBy: 'team', targetEntity: Player::class)]
    private Collection $players;

    #[ORM\OneToOne(mappedBy: 'team', targetEntity: Game::class)]
    #[Groups(['team'])]
    private ?Game $game = null;

    public function __construct(?array $payload = null)
    {
        $this->players = new ArrayCollection();
        parent::__construct($payload);
    }

    public function getPlayers(): ?Collection
    {
        return $this->players;
    }

    public function addPlayer(Player $player)
    {
        if (!$this->players->contains($player)) {
            $this->players->add($player);
        }
    }

    public function removePlayer(Player $player)
    {
        if ($this->players->contains($player)) {
            $this->players->remove($player);
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
     * @return Team
     */
    public function setId(?int $id): Team
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
     * @return Team
     */
    public function setName(?string $name): Team
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getStadium(): ?string
    {
        return $this->stadium;
    }

    /**
     * @param string|null $stadium
     * @return Team
     */
    public function setStadium(?string $stadium): Team
    {
        $this->stadium = $stadium;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCoach(): ?string
    {
        return $this->coach;
    }

    /**
     * @param string|null $coach
     * @return Team
     */
    public function setCoach(?string $coach): Team
    {
        $this->coach = $coach;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return Team
     */
    public function setUser(?User $user): Team
    {
        $this->user = $user;
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
     * @return Team
     */
    public function setChampionship(?Championship $championship): Team
    {
        $this->championship = $championship;
        return $this;
    }

    /**
     * @return Game|null
     */
    public function getGame(): ?Game
    {
        return $this->game;
    }

    /**
     * @param Game|null $game
     * @return Team
     */
    public function setGame(?Game $game): Team
    {
        $this->game = $game;
        return $this;
    }
}