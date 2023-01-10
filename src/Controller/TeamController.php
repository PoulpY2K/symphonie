<?php

namespace App\Controller;

use App\Entity\Answer;
use App\Entity\Participation;
use App\Entity\Player;
use App\Entity\Poll;
use App\Entity\Question;
use App\Entity\Team;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    #[Route('/teams', methods: ['GET'])]
    #[Route('/users/{id}/teams', methods: ['GET'])]
    public function getTeams(EntityManagerInterface $entityManager, $id = null): JsonResponse
    {
        $teamRepository = $entityManager->getRepository(Team::class);

        if (null === $id) {
            $teams = $teamRepository->findAll();
        } else {
            $userRepository = $entityManager->getRepository(User::class);
            $user = $userRepository->find($id);

            if (null === $user) {
                return new JsonResponse(['message' => "User not found"], Response::HTTP_NOT_FOUND);
            }

            $teams = $user->getTeams();
        }

        return $this->json($teams, Response::HTTP_OK);
    }

    #[Route('/teams', methods: ['POST'])]
    public function createTeam(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $payload = json_decode($request->getContent(), true);
        $userRepository = $entityManager->getRepository(User::class);

        $payload['user'] = $userRepository->find($payload['user']);

        if (null === $payload['user']) {
            return new JsonResponse([], Response::HTTP_BAD_REQUEST);
        }

        $team = new Team($payload);

        $entityManager->persist($team);
        $entityManager->flush();

        return $this->json($team, Response::HTTP_CREATED);
    }
}