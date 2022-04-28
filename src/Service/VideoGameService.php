<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\VideoGame;
use App\Repository\VideoGameRepository;
use Doctrine\ORM\EntityManagerInterface;

class VideoGameService
{
    public function __construct(
        private VideoGameRepository $videoGameRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function getVideoGamesByCriteria(?string $genre, ?string $status, ?string $developerName): array
    {
        return $this->videoGameRepository->getVideoGamesByCriteria($genre, $status, $developerName);
    }

    public function addVideoGame(array $data)
    {
        $videoGame = new VideoGame();
        $videoGame
            ->setName($data["name"])
            ->setDeveloper($data['developer'])
            ->setGenres($data['genres']);

        $this->entityManager->persist($videoGame);
        $this->entityManager->flush();
    }

    public function updateVideoGame(VideoGame $videoGame, array $data)
    {
        if (isset($data['name'])) {
            $videoGame->setName($data['name']);
        }

        if (isset($data['developer'])) {
            $videoGame->setDeveloper($data['developer']);
        }

        if (isset($data['genres'])) {
            $videoGame->setGenres($data['genres']);
        }

        $this->entityManager->flush();
    }

    public function deleteVideoGame(VideoGame $videoGame)
    {
        $this->entityManager->remove($videoGame);
        $this->entityManager->flush();
    }
}
