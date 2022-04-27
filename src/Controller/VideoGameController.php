<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\VideoGame;
use App\Service\VideoGameService;
use App\Validator\AddVideoGameValidator;
use App\Validator\UpdateVideoGameValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VideoGameController extends AbstractController
{
    public function __construct(
        private VideoGameService $videoGameService
    ) {}

    /**
     * @Route("/api/videogames", name="videogames", methods={"GET"})
     */
    public function getVideoGames(): JsonResponse
    {
        $data = $this->videoGameService->getAllVideoGames();

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("/api/videogames/{id}", name="videogames_get_one", methods={"GET"})
     */
    public function getVideoGame(VideoGame $videoGame): JsonResponse
    {
        return new JsonResponse($videoGame, Response::HTTP_OK);
    }

    /**
     * @Route("/api/videogames", name="videogames_add", methods={"POST"})
     */
    public function addVideoGame(Request $request): JsonResponse
    {
        $validator = new AddVideoGameValidator();

        $data = json_decode($request->getContent(), true);
        if ($validator->isValid($data)) {
            $this->videoGameService->addVideoGame($data);

            return new JsonResponse(['success' => true], Response::HTTP_CREATED);
        }

        return new JsonResponse([
            'success' => false,
            'errors' => $validator->getErrors(),
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/videogames/{id}", name="videogames_update", methods={"PUT"})
     */
    public function updateVideoGame(VideoGame $videoGame, Request $request): JsonResponse
    {
        $validator = new UpdateVideoGameValidator();

        $data = json_decode($request->getContent(), true);
        if ($validator->isValid($data)) {
            $this->videoGameService->updateVideoGame($videoGame, $data);

            return new JsonResponse(['success' => true], Response::HTTP_OK);
        }

        return new JsonResponse([
            'success' => false,
            'errors' => $validator->getErrors(),
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @Route("/api/videogames/{id}", name="videogames_delete", methods={"DELETE"})
     */
    public function deleteVideoGame(VideoGame $videoGame): JsonResponse
    {
        $this->videoGameService->deleteVideoGame($videoGame);

        return new JsonResponse(['status' => true], Response::HTTP_NO_CONTENT);
    }

    /**
     * @Route("/api/videogames-by-genre/{genre}", methods={"GET"})
     */
    public function getVideoGamesByGenre(string $genre): JsonResponse
    {
        $data = $this->videoGameService->getVideoGameByGenre($genre);

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
