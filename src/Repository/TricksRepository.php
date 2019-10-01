<?php

namespace App\Repository;

use App\Entity\Tricks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Tricks|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tricks|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tricks[]    findAll()
 * @method Tricks[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TricksRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tricks::class);
    }

    /**
     * @return Tricks[]
     */

    public function findLatest()
    {
        return $this->createQueryBuilder('p')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Tricks[] Returns an array of Tricks objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tricks
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
