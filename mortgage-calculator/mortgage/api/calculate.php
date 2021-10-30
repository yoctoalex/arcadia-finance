<?php
    header('Access-Control-Allow-Origin: 20.85.88.234'); 
    header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
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
        switch ($zip[0]) {
            case "0":
                return 0.02732;
                break;
            case "1":
                return 0.025;
                break;
            case "2":
                return 0.02455;
                break;
            case "3":
                return 0.03115;
                break;   
            case "4":
                return 0.03214;
                break;   
            case "5":
                return 0.03115;
                break;   
            case "6":
                return 0.03159;
                break;                                                                            
            case "7":
                return 0.03299;
                break;            
            case "8":
                return 0.02988;
                break;    
            case "9":
                return 0.02678;
                break;                                                                                  
        }

        return 0.02875;
    }

    function getPropertyTaxRate($zip) {
        switch ($zip[0]) {
            case "0":
                return 0.007971;
                break;
            case "1":
                return 0.007855;
                break;
            case "2":
                return 0.007691;
                break;
            case "3":
                return 0.007712;
                break;   
            case "4":
                return 0.007917;
                break;   
            case "5":
                return 0.007983;
                break;   
            case "6":
                return 0.007765;
                break;                                                                            
            case "7":
                return 0.007839;
                break;            
            case "8":
                return 0.007847;
                break;    
            case "9":
                return 0.007882;
                break;                                                                                  
        }

        return 0.007971;
    }

    function getInsuranceRate($zip) {
        switch ($zip[0]) {
            case "0":
                return 0.00313;
                break;
            case "1":
                return 0.002989;
                break;
            case "2":
                return 0.00345;
                break;
            case "3":
                return 0.00288;
                break;   
            case "4":
                return 0.002956;
                break;   
            case "5":
                return 0.002972;
                break;   
            case "6":
                return 0.002887;
                break;                                                                            
            case "7":
                return 0.002779;
                break;            
            case "8":
                return 0.002851;
                break;    
            case "9":
                return 0.002999;
                break;     
        }        

        return 0.003;
    }

    $mortgageResult->interestRate = getInterestRate($mortgageResult->zip);
    $mortgageResult->monthlyPrincipal = round(calculateMonthlyPrincipal($mortgageResult->loan, $mortgageResult->interestRate, $mortgageResult->term), 2);
    
    $mortgageResult->propertyTaxes = round($mortgageResult->totalPrice * getPropertyTaxRate($mortgageResult->zip) / 12, 2);
    $mortgageResult->homeownersInsurance = round($mortgageResult->totalPrice * getInsuranceRate($mortgageResult->zip) / 12, 2);
    
    $mortgageResult->monthlyTotal = $mortgageResult->monthlyPrincipal + $mortgageResult->homeownersInsurance + $mortgageResult->propertyTaxes;

    echo json_encode($mortgageResult);
?>