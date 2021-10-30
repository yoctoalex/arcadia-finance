<?php
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Methods: GET, POST');
    header("Access-Control-Allow-Headers: X-Requested-With");
    header('Content-Type: application/json; charset=utf-8');

    class HealthcheckResult {
        public $date;
        public $status;
    }

    $healthcheckResult = new HealthcheckResult;
    $healthcheckResult->date = date("c");
    $healthcheckResult->status = "OK";

    echo json_encode($healthcheckResult);
?>