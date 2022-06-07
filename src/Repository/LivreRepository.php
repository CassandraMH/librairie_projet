<?php

namespace App\Repository;

use App\Data\Search;
use App\Entity\Livre;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

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
    private PaginatorInterface $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, Livre::class);
        $this->paginator = $paginator;
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



    /**
     * @param Search $search
     * @return Livre[]
     */

    public function findwithSubmit(Search $search): array
    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('c', 'p')
            ->join('p.auteur', 'c');
        if (!empty($search->lola)){
            $query = $query
                ->andWhere('c.nometprenom LIKE :string')
                ->setParameter('string', "%{$search->lola}%");
        }

        return $query->getQuery()->getResult();


    }

    /**
     * Récupère les produits en lien avec la recherche
     * @param Search $search
     * @return PaginationInterface
     */
    public function findSearch(Search $search): PaginationInterface
    {
        $query = $this
            ->createQueryBuilder('p')
            ->select('c', 'p')
            ->join('p.genrelitteraire', 'c');

        if (!empty($search->recherche)){
            $query = $query
                ->andWhere('p.titre LIKE :recherche')
                ->setParameter('recherche', "%{$search->recherche}%");
        }

        if (!empty($search->genrelitteraire)){
            $query = $query
                ->andWhere('c.id IN (:genrelitteraire)')
                ->setParameter('genrelitteraire', $search->genrelitteraire);
        }

        $query->getQuery()->getResult();
        return $this->paginator->paginate(
            $query,
            $search->page,
            15,
        );
    }

}
