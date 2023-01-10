<?php

namespace App\Controller;

use App\Entity\Championship;
use App\Entity\Team;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChampionshipController extends AbstractController
{
    #[Route('/championships/{id}', methods: ['GET'])]
    public function getOneChampionship($id, EntityManagerInterface $entityManager): JsonResponse
    {
        $championshipRepository = $entityManager->getRepository(Championship::class);
        $championship = $championshipRepository->find($id);

        if (null === $championship) {
            return new JsonResponse(['message' => 'Championship not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($championship, Response::HTTP_OK);
    }

    #[Route('/championships', methods: ['POST'])]
    public function createChampionship(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);
        $teamRepository = $entityManager->getRepository(Team::class);

        for ($i = 0; $i < count($payload['teams']); $i++) {
            $payload['teams'][$i] = $teamRepository->find($payload['teams'][$i]);

            if (null === $payload['teams'][$i]) {
                return new JsonResponse(['message' => "One team couldn't be found"], Response::HTTP_NOT_FOUND);
            }
        }

        $championship = new Championship($payload);

        $entityManager->persist($championship);
        $entityManager->flush();

        return $this->json($championship, Response::HTTP_CREATED);
    }
}