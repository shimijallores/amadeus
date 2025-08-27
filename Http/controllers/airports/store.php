<?php

use Http\forms\AirportsForm;
use Http\models\Airports;
use Http\Services\ExcelService;

// Load excel file and read data
$data = ExcelService::load($_FILES['excel']['tmp_name']);

// Loop through the data and prepare for insertion
for ($i = 1; $i < count($data); $i++) {
    $row = $data[$i];

    $airport = [
        'iata' => $row[0],
        'icao' => $row[1],
        'airport_name' => $row[2],
        'location_served' => $row[3],
        'time' => $row[4],
        'dst' => $row[5],
    ];

    // Validate the excel data
    AirportsForm::validate($airport);

    // Insert the data into the database
    (new Airports())->store($airport);
}

redirect('/airports');
