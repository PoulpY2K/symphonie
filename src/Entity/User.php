<?php

namespace App\Entity;

use App\Model\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User extends Entity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', unique: true)]
    private ?string $username = null;

    #[ORM\OneToMany(mappedBy: 'user', targetEntity: Team::class)]
    private Collection $teams;

    public function __construct(?array $payload = null)
    {
        $this->teams = new ArrayCollection();
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
            $team->setUser($this);
        }
    }

    public function removeTeam(Team $team)
    {
        if ($this->teams->contains($team)) {
            $this->teams->remove($team);
            $team->setUser(null);
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
     * @return User
     */
    public function setId(?int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return User
     */
    public function setEmail(?string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     * @return User
     */
    public function setUsername(?string $username): User
    {
        $this->username = $username;
        return $this;
    }
}