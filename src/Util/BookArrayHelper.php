<?php
namespace App\Util;
use App\Models\Book;

class BookArrayHelper
{
    public static function formatTitle(string $title): string
    {
        return ucwords(trim($title));
    }

    /**
     * get All books for an Auther
     * @param Book[] $books
     * @param string $author
     * @return Book[]
     */
    public static function filterByAuthor(array $books, string $author): array
    {
        return array_values(array_filter($books, fn(Book $book) => strtolower($book->getAuthor()) === strtolower($author)));
    }

    /**
     * Sort Books in ASC by default or you enter dir = Des
     * @param Book[] $books
     * @param string $dir
     * @return Book[]
     */
    public static function sortByPrice(array $books, string $dir = 'asc'): array
    {
        $orderASC = function (Book $bookA, Book $bookB): bool {
            return $bookA->getPrice() <= $bookB->getPrice();
        };
        $orderDES = function (Book $bookA, Book $bookB): bool {
            return $bookA->getPrice() >= $bookB->getPrice();
        };
        usort($books, $dir === "asc" ? $orderASC : $orderDES);

        return $books;
    }
    /**
     * Sum of (price × stock) for all books.
     * @param Book[] $books
     * @return float
     */
    public static function totalValue(array $books): float
    {
        return array_reduce(
            $books,
            fn(float $carry, Book $book) => $carry + ($book->getPrice() * $book->getStock()),
            0
        );
    }


    /**
     * Return books where $kw appears in title OR author (case-insensitive)
     * @param Book[] $books
     * @param string $kw
     * @return Book[]
     */
    public static function searchByKeyword(array $books, string $kw): array
    {
        return array_values(array_filter($books, fn(Book $book) => stripos($book->getAuthor(), $kw) !== false || stripos($book->getTitle(), $kw) !== false));
    }

}