<?php
function authenticate() {
    header('WWW-Authenticate: Basic realm="Test Authentication System"');
    header('HTTP/1.0 401 Unauthorized');
    echo "You must enter a valid login ID and password to access this resource\n";
    exit;
}

if (!isset($_SERVER['PHP_AUTH_USER']))
{
    authenticate();
}
else
{
	if ($_SERVER['PHP_AUTH_USER'] == "admin" && $_SERVER['PHP_AUTH_PW'] == "iloveblue")
	{
		$backend = getenv('BACKEND_URL');
		if (empty($backend)) {
			$backend = 'http://backend.internal:8080';
		}

		$_POST = json_decode(file_get_contents('php://input'), true);

		$variables_set ="on";

		if(!isset($_POST["company"]))
		{
			$variables_set = "off";
		}
		if(!isset($_POST["trans_value"]))
		{
			$variables_set = "off";
		}
		if(!isset($_POST["qty"]))
		{
			$variables_set = "off";
		}
		if(!isset($_POST["stock_price"]))
		{
			$variables_set = "off";
		}
		if(!isset($_POST["action"]))
		{
			$variables_set = "off";
		}

		if ($variables_set == "off")
		{
			header('HTTP/1.1 501 Variables not Set');
			exit(0);
		}

		if ($_POST["action"]=="buy")
		{
			sleep(1);

			$my_company = $_POST["company"];
			$my_trans_value = $_POST["trans_value"];
			$my_qty = $_POST["qty"];
			$my_trans_id = rand(300000000,999999999);


			$string = file_get_contents($backend."/files/stocks.json");
			$stocks = json_decode($string, true);
			$stocks[$my_company]['qty'] = $stocks[$my_company]['qty'] + $my_qty;
			$stocks[$my_company]['value'] = $stocks[$my_company]['value'] + $my_trans_value;


			$url = $backend.'/files/stocks.php';
			$ch = curl_init($url);
			$jsonDataEncoded = json_encode($stocks);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			$result = curl_exec($ch);


			if ($my_company == "FFIV")
			{
				$my_name = "F5 Networks";
			}
			if ($my_company == "MSFT")
			{
				$my_name = "Microsoft";
			}
			if ($my_company == "GOOGL")
			{
				$my_name = "Google";
			}
			if ($my_company == "AMZN")
			{
				$my_name = "Amazon";
			}

			$string = file_get_contents($backend."/files/stock_transactions.json");
			$stock_transactions_list = json_decode($string, true);

			$my_new_array = array();
			$array =  array (
				  'name' => $my_name,
				  'symbol' => $my_company,
				  'action' => 'buy',
				  'qty' => $my_qty,
				  'price' => '$'.$my_trans_value,
				  'date' => date("d.m.Y")
				);
			array_push($my_new_array,$array);

			foreach ($stock_transactions_list as $key)
			{
				array_push($my_new_array,$key);
			}

			$url = $backend.'/files/stock_transactions.php';
			$ch = curl_init($url);
			$jsonDataEncoded = json_encode($my_new_array);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
			$result = curl_exec($ch);


			echo '{"status":"success","name":"'.$my_name.'", "qty":"'.$my_qty.'","amount":"'.$my_trans_value.'", "transid":"'.$my_trans_id.'"}';
		}

	}
	else
	{
		header('HTTP/1.0 403 Forbidden');
		die ("Wrong Username/Password");
	}
}


?>
