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

    public function getVideoGamesByCriteria(?string $genre, ?string $status, ?string $developerName): array
    {
        $qb = $this->createQueryBuilder('vg');

        if ($genre) {
            $qb
                ->where('vg.genres LIKE :genre')
                ->setParameter(':genre', '%' . $genre . '%');
        }

        if ($status) {
            $qb
                ->andWhere('vg.status = :status')
                ->setParameter(':status', $status);
        }

        if ($developerName) {
            $qb
                ->join('vg.developer', 'd')
                ->andWhere('d.name = :developerName')
                ->setParameter(':developerName', $developerName);
        }

        return $qb
            ->getQuery()
            ->getResult();
    }
}
