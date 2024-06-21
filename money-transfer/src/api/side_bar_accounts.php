<?php

$authentication = false;
if (isset($_SERVER['PHP_AUTH_USER']))
{
	if ($_SERVER['PHP_AUTH_USER'] == "admin" && $_SERVER['PHP_AUTH_PW'] == "iloveblue")
	{
		$authentication = true;
	}
}
$backend = getenv('BACKEND_URL');
if (empty($backend)) {
	$backend = 'http://backend.internal:8080';
}

?>

<option id="select_1" value=1>
  Select Acount ...
</option>
<?php
	$string = file_get_contents($backend."/files/accounts.json");
	$accounts = json_decode($string, true);
	foreach ($accounts as $key)
	{
		if($key["currency"]=="EUR")
		{
			$symbol = '€';
		}
		else
		{
			$symbol = '£';
		}
		echo '
		<option class="'.$key["currency"].'" id="'.$key["id"].'" value=2>
			Acc-'.$key["id"].' ('.$symbol.$key["amount"].')
		</option>';
	}
?>
