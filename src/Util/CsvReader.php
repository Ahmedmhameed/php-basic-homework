<?php
namespace App\Util;
use App\Models\Book;

class CsvReader
{
    /**
     * get All books for an Auther
     * @param string $path
     * @return Book[]
     */
    public static function load(string $path): array
    {

        $resurse = fopen($path, "r");
        if ($resurse === false)
            throw new \BadFunctionCallException("No Such file");
        $books = [];
        echo fgets($resurse);
        while (true) {
            $line = fgets($resurse);
            if ($line === false) {
                break;
            }
            $values = \preg_split("/,/", $line);
            echo implode($values);
            $book = new Book(id: $values[0], title: $values[1]);
        }
        fclose($resurse);
        return [];
    }
}
