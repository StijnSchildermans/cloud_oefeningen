<?php

$start = microtime(true);

$rows = $_GET["rows"];



class RowFetcher extends Thread {
  
	public function __construct($start,$end){
		$this->start = $start;
		$this->end = $end;
	}

	public function run(){
        	$this->res = json_decode(file_get_contents("http://pascal/pascal.php?start=" . $this->start . "&end=" . $this->end));
	}
}




echo "<!DOCTYPE html>";
echo "<html>";
echo "<head>";
echo "<title>Pascal Triangle</title>";
echo "</head>";
echo "<body>";

echo "<h1>Pascal triangle with " . $rows . " rows</h1>";



$threads = array();
$treads[] = new RowFetcher(0,$rows-1);
$treads[] = new RowFetcher($rows-1,$rows);

foreach ($threads as $t){
	$t->start();
}

foreach ($threads as $t){
	$t->join();
}

$res = array_merge($threads[0]->res, $threads[1]->res);

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

