<?php

namespace App\Models;

class Product
{
    private string $name;
    private int $price;
    private string $category;

    public function __construct(string $name, int $price, string $category)
    {
        $this->name = $name;
        $this->price = $price;
        $this->category = $category;
    }

    public function getPrice() : int
    {
        return $this->price;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getCategory(): string
    {
        return $this->category;
    }

}