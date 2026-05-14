<?php
namespace App\Models;
class BookCollection
{
    private array $books = [];
    public function add(Book $book): self
    {
        $this->books[$book->getID()] = $book;
        return $this;
    }
    public function findById(int $id): ?Book
    {
        return $this->books[$id];
    }
    public function count(): int
    {
        return \count($this->books);
    }
    public function __toString(): string
    {
        //$books = array_map(fn($book) => $book->summary(), $this->books);
        $books = array_map(fn($book) => ((string) $book) . "\n <br/>", $this->books);
        return implode($books);
    }

    public function getAvailableBook(): array
    {
        return array_values(array_filter($this->books, fn(Book $book) => $book->isAvailable()));
    }
}

