<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

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
    
    public function findByExampleField()
    {
        return $this->createQueryBuilder('l')
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult()
        ;
    }
    
    
    public function findAllWithoutOldComite()
    {
        return $this->createQueryBuilder('livre')
            ->addSelect('livre')
            ->leftJoin('livre.famille', 'f')
            ->andWhere('fc.actif = 1')
            ->leftJoin('fc.comite', 'c')
            ->orderBy('f.nomChefFoyer', 'ASC')
            ->getQuery()
            ->getResult()
            ;
    }

    // Pour la requête du tabs
    public function findMyLivre($value)
    {
        return $this
            ->createQueryBuilder('l')
            ->leftJoin("l.tabs", "t")
            ->andWhere('genrelitteraire.id in (:value)')
            ->setParameter('value', $value)
            ->getQuery()
            ->getREsult();
    }

    // Find/search articles by title/content
    public function findLivreByAuteur(string $query)
    {
        $qb = $this->createQueryBuilder('l');
        $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->orX(
                        $qb->expr()->like('l.auteur', ':query'),
                    ),
                )
            )
            ->setParameter('query', '%' . $query . '%')
        ;
        return $qb
            ->getQuery()
            ->getResult();
    }

    /*
    public function findOneBySomeField($value): ?Livre
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
