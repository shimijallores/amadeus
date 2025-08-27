<?php

use Http\forms\AirlinesForm;
use Http\models\Airlines;
use Http\Services\ExcelService;

// Load excel file and read data
$data = ExcelService::load($_FILES['excel']['tmp_name']);

// Loop through the data and prepare for insertion
for ($i = 1; $i < count($data); $i++) {
    $row = $data[$i];

    $airline = [
        'iata' => $row[0],
        'icao' => $row[1],
        'airline' => $row[2],
        'callsign' => $row[3],
        'country' => $row[4],
        'comments' => $row[5],
    ];

    // Validate the excel data
    AirlinesForm::validate($airline);

    // Insert the data into the database
    (new Airlines())->store($airline);
}

redirect('/airlines');
