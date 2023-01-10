<?php

namespace App\Repository;

use App\Entity\Game;
use Doctrine\ORM\EntityRepository;

class TeamRepository extends EntityRepository
{
    public function getGameCountOfTeam($team)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select($qb->expr()->count('g.id'))
            ->from(Game::class, 'g')
            ->join('g.homeTeam', 'ht')
            ->join('g.outsiderTeam', 'ot')
            ->where('ht.id = :team')
            ->orWhere('ot.id = :team')
            ->setParameter('team', $team);

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getResultsOfGames($team)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select($qb->expr()->count('g.id'))
            ->from(Game::class, 'g')
            ->join('g.homeTeam', 'ht')
            ->join('g.outsiderTeam', 'ot')
            ->where('ht.id = :team')
            ->andWhere('g.homeScore > g.outsiderScore')
            ->setParameter('team', $team);

        $wins = $qb->getQuery()->getSingleScalarResult();

        $qb->select($qb->expr()->count('g.id'))
            ->from(Game::class, 'g')
            ->join('g.homeTeam', 'ht')
            ->join('g.outsiderTeam', 'ot')
            ->where('ht.id = :team')
            ->andWhere('g.homeScore > g.outsiderScore')
            ->setParameter('team', $team);

        $loses = $qb->getQuery()->getSingleScalarResult();

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function getGoalsScored($team)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select("SUM(g.homeScore + g.outsiderScore)")
            ->from(Game::class, 'g')
            ->join('g.homeTeam', 'ht')
            ->join('g.outsiderTeam', 'ot')
            ->where('ht.id = :team')
            ->orWhere('ot.id = :team')
            ->setParameter('team', $team);

        $scores = $qb->getQuery()->getScalarResult();

        return array_sum($scores);
    }
}
