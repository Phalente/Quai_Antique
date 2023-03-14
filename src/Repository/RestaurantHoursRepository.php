<?php

namespace App\Repository;

use App\Entity\RestaurantHours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RestaurantHours>
 *
 * @method RestaurantHours|null find($id, $lockMode = null, $lockVersion = null)
 * @method RestaurantHours|null findOneBy(array $criteria, array $orderBy = null)
 * @method RestaurantHours[]    findAll()
 * @method RestaurantHours[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestaurantHoursRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, RestaurantHours::class);
  }

  public function save(RestaurantHours $entity, bool $flush = false): void
  {
    $this->getEntityManager()->persist($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  public function remove(RestaurantHours $entity, bool $flush = false): void
  {
    $this->getEntityManager()->remove($entity);

    if ($flush) {
      $this->getEntityManager()->flush();
    }
  }

  //    /**
  //     * @return RestaurantHours[] Returns an array of RestaurantHours objects
  //     */
  //    public function findByExampleField($value): array
  //    {
  //        return $this->createQueryBuilder('r')
  //            ->andWhere('r.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->orderBy('r.id', 'ASC')
  //            ->setMaxResults(10)
  //            ->getQuery()
  //            ->getResult()
  //        ;
  //    }

  //    public function findOneBySomeField($value): ?RestaurantHours
  //    {
  //        return $this->createQueryBuilder('r')
  //            ->andWhere('r.exampleField = :val')
  //            ->setParameter('val', $value)
  //            ->getQuery()
  //            ->getOneOrNullResult()
  //        ;
  //    }
}
