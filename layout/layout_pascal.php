<?php

$start = microtime(true);

$rows = $_GET["rows"];

$res = json_decode(file_get_contents("http://pascal/pascal.php?start=0&end=" . $rows));

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Pascal Triangle</title>";
echo "</head>";
echo "<body>";

echo "<h1>Pascal triangle with " . $rows . " rows</h1>";


echo "<table style=\"width:100%\">";
	
foreach ($res as $row) {
	echo "<tr>";
		foreach ($row as $elem){
			echo "<td>" . $elem . "</td>";
		}
	echo "</tr>";
}
    
echo "</table>";

echo "</body>";
echo "</html>";

$duration = microtime(true) - $start;

echo "<p>Generated in " . $duration . " seconds.</p>"


?>

