<?php

namespace App\Controller;

use App\Entity\Championship;
use App\Entity\Day;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DayController extends AbstractController
{
    #[Route('/days', methods: ['POST'])]
    public function createDay(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);
        $championshipRepository = $entityManager->getRepository(Championship::class);
        $teamRepository = $entityManager->getRepository(Team::class);

        $payload['championship'] = $championshipRepository->find($payload['championship']);

        if (null === $payload['championship']) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }

        for ($i = 0; $i < count($payload['games']); $i++) {
            $payload['games'][$i]['homeTeam'] = $teamRepository->find($payload['games'][$i]['homeTeam']);
            $payload['games'][$i]['outsiderTeam'] = $teamRepository->find($payload['games'][$i]['outsiderTeam']);

            if (null === $payload['games'][$i]['homeTeam'] || null === $payload['games'][$i]['outsiderTeam']) {
                return new JsonResponse(['message' => "One of the team in the game " . $i + 1 . " couldn't be found"], Response::HTTP_NOT_FOUND);
            }
        }

        $day = new Day($payload);

        $entityManager->persist($day);
        $entityManager->flush();

        return $this->json($day, Response::HTTP_CREATED);
    }
}