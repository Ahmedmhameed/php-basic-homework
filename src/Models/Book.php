<?php

namespace App\Models;

use App\Contracts\Discountable;
use App\Traits\Timestampable;
class Book implements Discountable
{
    use Timestampable;
    public function __construct(
        private readonly int $id,
        private string $title,
        private string $author,
        private string $genre,
        private float $price,
        private string $isbn,
        private int $year,
        private int $pages,
        private int $stock = 0,

    ) {
        $this->initTimestamps();
    }
    public function summary(): string
    {
        return "[{$this->id}] {$this->title} by {$this->author} — \${$this->price} ({$this->stock} in stock)";
    }
    public function isAvailable(): bool
    {
        return $this->stock > 0;
    }
    public function checkout()
    {
        if (!$this->isAvailable()) {
            throw new \RuntimeException('Out of stock');
        }
        $this->stock--;
    }
    public function applyDiscount(float $pct): float
    {
        return $this->price * (1 - $pct / 100);
    }

    public function getID()
    {
        return $this->id;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
    public function getAuthor(): string
    {
        return $this->author;
    }
    public function getPrice(): float
    {
        return $this->price;
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getPages(): int
    {
        return $this->pages;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;

    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;
        return $this;

    }

    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;

    }

    public function setIsbn(string $isbn): self
    {
        $this->isbn = $isbn;
        return $this;

    }

    public function setYear(int $year): self
    {
        $this->year = $year;
        return $this;

    }

    public function setPages(int $pages): self
    {
        $this->pages = $pages;
        return $this;

    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;
        return $this;

    }

    public function __toString(): string
    {
        return $this->summary();
    }
}