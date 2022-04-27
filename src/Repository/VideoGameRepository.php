<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\VideoGame;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VideoGameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoGame::class);
    }

    public function getVideoGamesByGenre(string $genre): array
    {
        return $this
            ->createQueryBuilder('vg')
            ->where('vg.genres LIKE :genre')
            ->setParameter(':genre', '%' . $genre . '%')
            ->getQuery()
            ->getResult();
    }
}
