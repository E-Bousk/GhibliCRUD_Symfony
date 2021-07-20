<?php

namespace App\Repository;

use App\Entity\Anim;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Anim|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anim|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anim[]    findAll()
 * @method Anim[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anim::class);
    }


    /**
     * @return Anim[]
     */
    public function findAllYear() :array
    {
        return $this->findYearQuery()
        ->getQuery()
        ->getResult();
    }

    /**
     * @return Anim[]
     */
    public function findlatest() :array
    {
        return $this->findYearQuery()
        ->setMaxResults(4)
        ->getQuery()
        ->getResult();
    }


    private function findYearQuery()// : QueryBuilder
    {
        return $this->createQueryBuilder('a')
        ->where('a.year = 1986') ;
    }

    // /**
    //  * @return Anim[] Returns an array of Anim objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Anim
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
