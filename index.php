<?php

// Include
@include("class/calculator.class.php");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Projekt</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>

<?php

// Iniciacija klase
$calculator = new Calculator();

// Računanje
if (isset($_REQUEST['x']) && isset($_REQUEST['y'])) {
	// Računanje i spis
	echo "Rezultat: ".$calculator->CalculateResult($_REQUEST['x'], $_REQUEST['y'], '*');
}

?>

<table cellpadding="0" cellspacing="0" border="1">

<?php

// Generisanje tabele
for ($row=1; $row<=$no_rows; $row++) {
	echo "<tr>";
		for ($column=1; $column<=$no_colums; $column++) {
			echo "<td><a href='index.php?x=".$row."&y=".$column."'>".$row."x".$column."</a></td>";
		}
	echo "</tr>";
}

?>

</table>

</body>
</html>