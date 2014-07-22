<?php
$nameArr = array("A" => 65, "B" => 66, "C" => 67, "D" => 68, "E" => 69, "F" => 70, "G" => 71, "H" => 72,
			"I" => 73, "J" => 74, "K" => 75, "L" => 76, "M" => 77, "N" => 78, "O" => 79, "P" => 80,
			"Q" => 81, "R" => 82, "S" => 83, "T" => 84, "U" => 85, "V" => 86, "W" => 87, "X" => 88,
			"Y" => 89, "Z" => 90
		 );

$xArr = array(38,56,57,57,99,
			  15,58,12,13,17,
			  19,18,88,58,52,
			  52,12,13,12,57,
			  52,98
		);

$username = $_GET['username'];



if (isset($username) && !empty($username)) {
	$uLen = strlen($username);

	$arrFirsts = str_split(strtoupper($username));

	$counter = 0;
	$i = 1;
	foreach ($arrFirsts as $arrFirst) {

		if ($counter < 3) {

			$tmpNum[] = ($nameArr[$arrFirst] * $uLen) % 100;

		} else {

			$tmpNum[] = (($nameArr[$arrFirst] * $uLen) + $tmpNum[$counter - 3]) % 100;

		}

		$D[$i] = $tmpNum[$counter];
		$D[4] = 99;
		$D[5] = 99;
		if ($i == 3) { $i = 0; }
		$counter++;
		$i++;
	}

	$inVal = 0;
	for ($i=1; $i<=5; $i++) {
		$inVal = ((($D[$i] * $uLen) + $inVal) - (floor(((($D[$i]  * $uLen) + $inVal) / 22)) * 22));
	}

	$D[6] = $D[5];
	$D[5] = $xArr[$inVal];

	for ($i = 1; $i < 7; $i++) {
		$D[$i] = sprintf('%02d', $D[$i]);
	}

	return print("Key is : " . $D[6] . $D[5] . $D[4] . $D[1] . $D[2] . $D[3]);
?>

<!Doctype html>
<html>
<head>
<title>Smadav Key Generator</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>

<div style="height:100px"></div>

<center>
<input type="text" class="username" name="username" placeholder="Masukkan Nama" value="">
<input type="button" class="button-generator" name="submit" onclick="getKey()" value="Generate"><br>
<div class="key-generated">Key not generated</div>

<script type="text/javascript">

function getKey() {
	var getName = $('.username').val();

	$.ajax({
		url: 'smadav.php?username=' + getName,
		dataType: 'text',
		success: function(data) { 
			$('.key-generated').text(data);
		},
	});

}

</script>

</center>

</body>
</html>
