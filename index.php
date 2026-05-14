<?php
namespace App;
require_once __DIR__ . "/vendor/autoload.php";
use App\Models\BookCollection;
use App\Util\CsvReader;
use App\Util\BookArrayHelper;

$books = CsvReader::load(__DIR__ . "/data/books.csv");
$collection = new BookCollection();
foreach ($books as $book) {
    $collection->add($book);
}
$array = $collection->getAvailableBook();
$array = BookArrayHelper::sortByPrice($array);
CsvReader::ReportWriter($array, __DIR__ . "/data/report.txt");
echo "Report written.";