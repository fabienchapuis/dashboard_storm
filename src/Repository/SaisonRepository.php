<?php

namespace App\Repository;

use App\Entity\Saison;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\DBAL\Query\QueryBuilder;

/**
 * @method Saison|null find($id, $lockMode = null, $lockVersion = null)
 * @method Saison|null findOneBy(array $criteria, array $orderBy = null)
 * @method Saison[]    findAll()
 * @method Saison[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SaisonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Saison::class);
    }

     /**
      * @return Saison[] Returns an array of Saison objects
      */
    
    // public function findAll(): QueryBuilder
    // {
    //     return $this->createQueryBuilder('s')
    //         ->andWhere('s.nom = false')
    //         ->setMaxResults(4)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }


    /*
    public function findOneBySomeField($value): ?Saison
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
