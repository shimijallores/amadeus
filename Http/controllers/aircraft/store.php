<?php

use Http\forms\AircraftForm;
use Http\models\Aircraft;
use Http\Services\ExcelService;

// Load excel file and read data
$data = ExcelService::load($_FILES['excel']['tmp_name']);

// Loop through the data and prepare for insertion
for ($i = 1; $i < count($data); $i++) {
    $row = $data[$i];

    $aircraft = [
        'iata' => $row[0],
        'icao' => $row[1],
        'model' => $row[2],
    ];

    // Validate the excel data
    AircraftForm::validate($aircraft);

    // Insert the data into the database
    (new Aircraft())->store($aircraft);
}

redirect('/airports');
