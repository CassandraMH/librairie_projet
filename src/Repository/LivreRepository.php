<?php

namespace App\Repository;

use App\Entity\Genrelitteraire;
use App\Entity\Livre;
use App\Entity\Pagesearch;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Livre>
 *
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Livre $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Livre $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Livre[] Returns an array of Livre objects
    //  */
    
    public function findByLivreFantasy($id = 1)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.genrelitteraire = :val')
            ->setParameter('val', $id)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByLivreFantastique($id = 2)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.genrelitteraire = :val')
            ->setParameter('val', $id)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByLivreCinema($id = 3)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.genrelitteraire = :val')
            ->setParameter('val', $id)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByLivreSF($id = 4)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.genrelitteraire = :val')
            ->setParameter('val', $id)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBySearch(Pagesearch $pagesearch): array
    {
        return $this->createQueryBuilder('l')
            ->select('l', 'a')
            ->leftjoin('a.id', 'l');

            if (!empty($pagesearch->l)) {
                $query = $query
                ->andWhere('l.auteur LIKE :auteur')
            ->setParameter('auteur', '%'.$pagesearch.'%');

            }
            
            return $query->getQuery()->getResult();

    }
}