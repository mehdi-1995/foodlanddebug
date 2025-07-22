<?php

// app/Imports/MenuImport.php
namespace App\Imports;

use App\Models\MenuItem;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MenuImport implements ToModel, WithHeadingRow
{
    private $restaurantId;

    public function __construct($restaurantId)
    {
        $this->restaurantId = $restaurantId;
    }

    public function model(array $row)
    {
        return new MenuItem([
            'restaurant_id' => $this->restaurantId,
            'name' => $row['name'],
            'price' => $row['price'],
            'description' => $row['description'],
            'category' => $row['category'],
            'image' => $row['image'] ?? 'https://via.placeholder.com/150x100',
        ]);
    }
}
