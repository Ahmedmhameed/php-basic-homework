<?php
namespace App\Util;
use App\Models\Book;

class CsvReader
{
    /**
     * get All books for an Author
     * @param string $path
     * @return Book[]
     */
    public static function load(string $path = __DIR__ . "/../../data/books.csv"): array
    {
        $resource = fopen($path, "r");
        if ($resource === false)
            throw new \BadFunctionCallException("No Such file");

        $books = [];

        // Skip header row
        fgets($resource);

        while (true) {
            $line = fgets($resource);
            if ($line === false) {
                break;
            }

            // Parse CSV line
            $values = \preg_split("/,/", trim($line));

            if (isset($values[0]) && isset($values[1])) {
                $book = new Book(
                    id: (int) $values[0],
                    title: trim($values[1]),
                    author: trim($values[2]),
                    genre: trim($values[3]),
                    price: (float) $values[4],
                    stock: (int) $values[5],
                    isbn: trim($values[6]),
                    year: (int) $values[7],
                    pages: (int) $values[8]
                );
                $books[] = $book;
            }
        }

        fclose($resource);
        return $books;
    }
    public static function save(array $books, string $path = __DIR__ . "/../../data/books.csv"): void
    {
        $resource = fopen($path, "w");
        if ($resource === false)
            throw new \BadFunctionCallException("Cannot create or open file");
        // Write each book
        foreach ($books as $book) {
            $line = $book->toString() . "\n";
            fwrite($resource, $line);
        }

        fclose($resource);
    }
    public static function ReportWriter(array $books, string $path): void
    {
        $resource = fopen($path, "w");
        if ($resource === false)
            throw new \BadFunctionCallException("Cannot create or open file");
        // Write each book
        foreach ($books as $book) {
            $line = $book . "\n";
            fwrite($resource, $line);
        }
        fclose($resource);
    }
}
