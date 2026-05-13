<?php
namespace App;
require_once __DIR__ . "/vendor/autoload.php";
use App\Models\Book;
use App\Models\BookCollection;
use Carbon\Carbon;
use App\Util\CsvReader;

// // Expected output:
// $col = new BookCollection();
// $col->add(new Book(1, 'Dune', 'Herbert', 18.99, 3))->add(new Book(2, '1984', 'Orwell', 12.50, 0));
// echo $col->count(); // 2
// echo $col; // calls __toString
// // [1] Dune by Herbert...
// // [2] 1984 by Orwell...

echo "<br/>";
// $carbon = new Carbon($col->findById(1)->getCreatedAt());
// echo $carbon->diffForHumans() . "\n";
echo "<pre>";
var_dump(CsvReader::load(__DIR__ . "/data/books.csv"));
echo "</pre>";