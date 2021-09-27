<?php
    header("Access-Control-Allow-Origin: *");
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