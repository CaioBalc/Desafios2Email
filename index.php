<?php

use League\Csv\Reader;
use League\Csv\Writer;
use index;

require __DIR__ ."/vendor/autoload.php";

#private function generateSalesCsv(){
    $file = fopen(self::$sales_csv_name, 'w');
    fputcsv($file, ['product_id', 'unit_price', 'date_last_sale', 'total_quantity', 'total_price']);
    
    $output = true;
    if($output){
        $generate = (new index())->find()->fetch(all: true);
        $csv = Writer::createFromString(content: "");
    }

    $read = false;
    if($read){
        $stream = fopen(filename: __DIR__ .'GenerateCSV.php', mode:'r');
        $csv = Reader::createFromStream($stream);
       $csv->setDelimiter(delimiter: ',');
    }

#}