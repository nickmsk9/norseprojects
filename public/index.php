<?php

declare(strict_types=1);

require dirname(__DIR__) . '/vendor/autoload.php';


echo "Hello World!" . PHP_EOL;

use App\Models\Product;

$product = new Product("Anton Oxford shirt", 15000, "shirts");

echo $product->getName();
echo "\n";
echo $product->getPrice();
echo "\n";
echo $product->getCategory();


