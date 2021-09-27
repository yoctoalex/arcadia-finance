<?php
    header("Access-Control-Allow-Origin: *");
    header('Content-Type: application/json; charset=utf-8');
    // http://localhost:5080/mortgage/api/calculate.php?price=200000&down=100000&term=360&zip=98034
    class MortgageResult {
        public $totalPrice;
        public $downPayment;
        public $loan;
        public $term;
        public $zip;
        public $monthlyPrincipal;
        public $propertyTaxes;
        public $homeownersInsurance;
        public $interestRate;
        public $monthlyTotal;
    }

    $mortgageResult = new MortgageResult;

    $mortgageResult->totalPrice = floatval($_GET['price']);
    $mortgageResult->downPayment = floatval($_GET['down']);
    $mortgageResult->loan = $mortgageResult->totalPrice - $mortgageResult->downPayment;
    $mortgageResult->term = floatval($_GET['term']);
    $mortgageResult->zip = $_GET['zip'];


    function calculateMonthlyPrincipal($loan, $interest, $term) {
        $interest = $interest / 12;
        return $loan * ($interest * pow((1 + $interest), $term) / (pow((1 + $interest), $term) - 1));
    }

    function getInterestRate($zip) {
        return 0.02875;
    }

    function getPropertyTaxRate($zip) {
        return 0.007971;
    }

    function getInsuranceRate($zip) {
        return 0.003;
    }

    $mortgageResult->interestRate = getInterestRate($mortgageResult->zip);
    $mortgageResult->monthlyPrincipal = calculateMonthlyPrincipal($mortgageResult->loan, $mortgageResult->interestRate, $mortgageResult->term);
    
    $mortgageResult->propertyTaxes = $mortgageResult->totalPrice * getPropertyTaxRate($mortgageResult->zip) / 12;
    $mortgageResult->homeownersInsurance = $mortgageResult->totalPrice * getInsuranceRate($mortgageResult->zip) / 12;
    
    $mortgageResult->monthlyTotal = $mortgageResult->monthlyPrincipal + $mortgageResult->homeownersInsurance + $mortgageResult->propertyTaxes;

    echo json_encode($mortgageResult);
?>