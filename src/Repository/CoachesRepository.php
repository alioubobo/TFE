<?php

namespace App\Repository;

use App\Entity\Coaches;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Coaches>
 *
 * @method Coaches|null find($id, $lockMode = null, $lockVersion = null)
 * @method Coaches|null findOneBy(array $criteria, array $orderBy = null)
 * @method Coaches[]    findAll()
 * @method Coaches[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CoachesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Coaches::class);
    }

    public function add(Coaches $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Coaches $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
    * @return Coaches[] Returns an array of Coaches objects
    */
    public function lastCoaches(): array
    {
        return $this->createQueryBuilder('c')          
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }


//    /**
//     * @return Coaches[] Returns an array of Coaches objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Coaches
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findCoach($name = null, $training = null)
    {
       //table links
        $queryBuilder = $this->createQueryBuilder('c');        

        //if the name field is populated
        if($name){
            $queryBuilder
            ->andWhere('c.name LIKE :nameCoach')
            ->setParameter('nameCoach', '%'.$name.'%');
        }

        //if the training field is populated 
        if($training){
            $queryBuilder
            ->join('c.trainings', 't')
            ->andWhere('t.name LIKE :nametrainings')
            ->setParameter('nametrainings', '%'.$training.'%');
        }   

        return $queryBuilder
        ->orderBy('c.name')
        ->getQuery()        
        ->getResult()
        ;
    }  


}
