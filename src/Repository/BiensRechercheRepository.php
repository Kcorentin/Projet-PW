<?php

namespace App\Repository;

use App\Entity\BiensRecherche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BiensRecherche>
 *
 * @method BiensRecherche|null find($id, $lockMode = null, $lockVersion = null)
 * @method BiensRecherche|null findOneBy(array $criteria, array $orderBy = null)
 * @method BiensRecherche[]    findAll()
 * @method BiensRecherche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiensRechercheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BiensRecherche::class);
    }

    public function save(BiensRecherche $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(BiensRecherche $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return BiensRecherche[] Returns an array of BiensRecherche objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?BiensRecherche
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
