<?php

namespace App\Repository;

use App\Entity\Envoyer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Envoyer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Envoiyer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Envoyer[]    findAll()
 * @method Envoyer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnvoyerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Envoyer::class);
    }

    // /**
    //  * @return Envoyer[] Returns an array of Envoyer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Envoyer
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
