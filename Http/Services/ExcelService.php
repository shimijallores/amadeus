<?php

namespace Http\Services;

use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelService
{
    public static function load(string $filePath) : array
    {
        $spreadsheet = IOFactory::load($filePath);

        return $spreadsheet->getActiveSheet()->toArray();
    }
}