<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
     * Recherche des événements en fonction des critères donnés.
     *
     * @param array $criteria
     * @return Event[]
     */
    public function searchEvents(array $criteria): array
    {
        $qb = $this->createQueryBuilder('e');
    
        if (!empty($criteria['id'])) {
            $qb->andWhere('e.id = :id')
               ->setParameter('id', $criteria['id']);
        }
        if (!empty($criteria['nomEV'])) {
            $qb->andWhere('e.nomEV LIKE :nomEV')
               ->setParameter('nomEV', '%' . $criteria['nomEV'] . '%');
        }
        if (!empty($criteria['dateEV'])) {
            $qb->andWhere('e.dateEV = :dateEV')
               ->setParameter('dateEV', new \DateTime($criteria['dateEV']));
        }
        if (!empty($criteria['lieuEV'])) {
            $qb->andWhere('e.lieuEV LIKE :lieuEV')
               ->setParameter('lieuEV', '%' . $criteria['lieuEV'] . '%');
        }
    
        return $qb->getQuery()->getResult();
    }
    
}
