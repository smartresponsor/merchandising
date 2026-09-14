<?php

declare(strict_types=1);

namespace App\Merchandising\Repository;

use App\Merchandising\Entity\MerchSurfaceEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Repository for configured merchandising surfaces.
 *
 * Runtime composition may still be source-driven; this repository exists for
 * managed/campaign surfaces once persistence is enabled.
 *
 * @extends ServiceEntityRepository<MerchSurfaceEntity>
 */
final class MerchSurfaceRepository extends ServiceEntityRepository
{
    /**
     * Initializes the MerchSurfaceRepository.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MerchSurfaceEntity::class);
    }
}
