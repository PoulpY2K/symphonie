<?php

namespace App\Controller;

use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatsController extends AbstractController
{
    #[Route('/stats/teams/{id}/games/count', methods: ['GET'])]
    public function getGameCount($id, EntityManagerInterface $entityManager): JsonResponse
    {
        $teamRepository = $entityManager->getRepository(Team::class);
        $count = $teamRepository->getGameCountOfTeam($id);

        return $this->json($count, Response::HTTP_OK);
    }

    #[Route('/stats/teams/{id}/scored', methods: ['GET'])]
    public function getScoredGoalsFromTeam($id, EntityManagerInterface $entityManager): JsonResponse
    {
        $teamRepository = $entityManager->getRepository(Team::class);
        $scored = $teamRepository->getGoalsScored($id);

        return $this->json($scored, Response::HTTP_OK);
    }
}