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

	  <table class="table table-compact smaller text-faded mb-0">
		<thead>
		  <tr>
			<th>
			  To
			</th>
			<th class="text-center">
			  Date
			</th>
			<th class="text-right">
			  Amount
			</th>
		  </tr>
		</thead>
		<tbody>
		<?php
			sleep (3);
			$string = file_get_contents($backend."/files/money_transfer.json");
			$tranfer_list = json_decode($string, true);
			$i = 0;
			foreach ($tranfer_list as $key)
			{
				if ($i>9)
					continue;
				echo'
				<tr>
				  <td>
					  '.$key["name"].'
				  </td>
				  <td class="text-center text-bright">
					  '.$key["amount"].'
				  </td>
				  <td class="text-right">
					  '.$key["date"].'
				  </td>
			  </tr>';
				$i++;
			}
		?>
		</tbody>
	  </table>
