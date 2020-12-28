<?php
$start = $_GET["start"];
$end = $_GET["end"];
$triangle = [];
for($i=$start;$i<$end;$i++)
{
    $row = [];
    for($j=0;$j<=$i;$j++)
    {
        array_push($row,get_elem($i,$j));
    }
    array_push($triangle,$row);
}
echo json_encode($triangle);

function get_elem($i,$j)
{
    if($j==0 || $j == $i)
    {
        return 1;
    }
    else 
    {
        return get_elem($i-1,$j-1)+get_elem($i-1,$j);
    }
}
?>

