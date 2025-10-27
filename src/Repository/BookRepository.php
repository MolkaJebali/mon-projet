<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
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

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


    // Avec DQL
public function getNbrBooks(): int
{
    return $this->getEntityManager()
        ->createQuery('SELECT COUNT(b.id) FROM App\Entity\Book b')
        ->getSingleScalarResult();
}

// Avec QueryBuilder
public function getNbrBooksQB(): int
{
    return $this->createQueryBuilder('b')
        ->select('COUNT(b.id)')
        ->getQuery()
        ->getSingleScalarResult();
}

// Avec DQL
public function getBooksByAuthor($authorId): array
{
    return $this->getEntityManager()
        ->createQuery('SELECT b FROM App\Entity\Book b WHERE b.author = :authorId')
        ->setParameter('authorId', $authorId)
        ->getResult();
}

// Avec QueryBuilder  
public function getBooksByAuthorQB($authorId): array
{
    return $this->createQueryBuilder('b')
        ->where('b.author = :authorId')
        ->setParameter('authorId', $authorId)
        ->getQuery()
        ->getResult();
}
}
