<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'API ID',
            'Title',
            'Price',
            'Description',
            'Category',
            'Image URL',
            'Rating',
            'Created At',
            'Updated At'
        ];
    }
}