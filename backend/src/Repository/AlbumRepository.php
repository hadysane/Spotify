<?php

namespace App\Repository;

use App\Entity\Album;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Track; 

/**
 * @method Album|null find($id, $lockMode = null, $lockVersion = null)
 * @method Album|null findOneBy(array $criteria, array $orderBy = null)
 * @method Album[]    findAll()
 * @method Album[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlbumRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Album::class);
    }

    // /**
    //  * @return Album[] Returns an array of Album objects
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
    public function findOneBySomeField($value): ?Album
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function allAlbum()
    {
        $qd = $this->createQueryBuilder('a')
        ->addSelect('COUNT(track.album) AS  count_track ')
        ->innerJoin('App\Entity\Track', 'track', 'WITH' ,'track.album = a.id')
        ->groupBy('a.id')
        ->getQuery(); 
        ;
        // dump($qd);
        return $qd->execute(); 
        
    }

    public function findTitle($name)
    {
        $qb = $this->createQueryBuilder('a')
        ->andWhere('a.name LIKE :name')
        ->orderBy('a.name', 'ASC')
        ->setParameter('name', $name.'%')
        ->getQuery(); 
        ;
            

        return $qb->execute(); 
        
    }
}
