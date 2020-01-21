<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\CustomerSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.id', 'DESC');
    }

    public function findAllVisibleQuery(CustomerSearch $search): Query
    {
        $query = $this->findVisibleQuery();

        if ($search->getNationality()){
            $query = $query
                ->innerJoin('c.nationality', 'n')
                ->addSelect('n')
                ->andWhere('c.nationality = :nationalityId')
                ->setParameter('nationalityId', $search->getNationality()->getId());
        }
        if ($search->getSearchText()){
            $query = $query
                ->andWhere('c.firstname LIKE :firstname OR c.lastname LIKE :lastname')
                ->setParameter('firstname', '%' . $search->getSearchText() . '%')
                ->setParameter('lastname', '%' . $search->getSearchText() . '%');
        }
        return $query->getQuery();
    }

    // /**
    //  * @return Customer[] Returns an array of Customer objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Customer
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
