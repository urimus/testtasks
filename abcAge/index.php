<?php
session_start();

  include "dbconnect.php";
 $conn = OpenCon();
//echo "Connected Successfully\n";
 



/*
$sql = "DROP TABLE warehouse;";
if ($conn->query($sql) === TRUE) {
	echo "Table warehouse deleted successfully\n";
} else {
	echo "Error deleting table: " . $conn->error."\n";
}
 
 

$sql = "CREATE TABLE `warehouse` (
  `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` text, 
  `costprice` INT,
  `remainder` INT
) ENGINE=InnoDB";


if ($conn->query($sql) === TRUE) {
	echo "Table warehouse created successfully\n";
} else {
	echo "Error creating table: " . $conn->error."\n";
}


$sql = "INSERT INTO `warehouse` (`name`, `remainder`, `costprice`) VALUES ('Колбаса', '0', '15');";
$conn->query($sql);
$sql = "INSERT INTO `warehouse` (`name`, `remainder`, `costprice`) VALUES ('Пармезан', '0', '550');";
$conn->query($sql);
$sql = "INSERT INTO `warehouse` (`name`, `remainder`, `costprice`) VALUES ('Левый носок', '0', '5');";
$conn->query($sql);


$sql = "DROP TABLE supplies;";
if ($conn->query($sql) === TRUE) {
	echo "Table supplies deleted successfully\n";
} else {
	echo "Error deleting table: " . $conn->error."\n";
}
 


$sql = "CREATE TABLE `supplies` (
  `id` INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `supplynum` text, 
  `product` text, 
  `amount` INT,
  `price` INT,
  `date` BIGINT
) ENGINE=InnoDB";

if ($conn->query($sql) === TRUE) {
	echo "Table supplies created successfully\n";
} else {
	echo "Error creating table: " . $conn->error."\n";
}

function strDateToTimestamp($strDate) {
	return DateTime::createFromFormat("Y-m-d", $strDate)->getTimestamp();
}

function insertSupply($conn, $supplynum, $product, $amount, $price, $date) {
	$sql = "INSERT INTO `supplies` (`supplynum`, `product`, `amount`, `price`, `date`) VALUES 
($supplynum, $product, $amount, $price, ".strDateToTimestamp($date).");";
	$conn->query($sql);
	$sql ="UPDATE warehouse SET `remainder` = `remainder` + $amount WHERE name='$product'";
	$conn->query($sql);
}

insertSupply($conn, '1', 'Колбаса', '300', '5000', '2021-01-01');
insertSupply($conn, 't-500', 'Пармезан', '10', '6000', '2021-01-02');
insertSupply($conn, '12-TP-777', 'Левый носок', '100', '500', '2021-01-13');
insertSupply($conn, '12-TP-778', 'Левый носок', '50', '300', '2021-01-14');
insertSupply($conn, '12-TP-779', 'Левый носок', '77', '539', '2021-01-20');
insertSupply($conn, '12-TP-779', 'Левый носок', '32', '176', '2021-01-30');
insertSupply($conn, '12-TP-977', 'Левый носок', '94', '554', '2021-02-01');
insertSupply($conn, '12-TP-979', 'Левый носок', '200', '1000', '2021-02-05');




*/


function getWares($conn) {
// read guestbook
	$sql="SELECT name, remainder, costprice FROM warehouse ORDER BY id ASC";
	$result=$conn->query($sql);
	
	$wares_array=[];

	if ($result->num_rows > 0) {
		while($row=mysqli_fetch_assoc($result)) {
			$wares_array[] = $row;
		}	
	}
	return $wares_array;
}


function fibonacci($n,$first = 0,$second = 1) {
    $fib = [$first,$second];
    for($i=1;$i<$n;$i++)
    {
        $fib[] = $fib[$i]+$fib[$i-1];
    }
    return $fib[$n];
}

function printData($conn) {
	

    $wares_array=getWares($conn);
//	print_r($wares_array);
//	echo ($_POST['date']);
	$dateTS=DateTime::createFromFormat("Y-m-d H:i", str_replace("T"," ",$_POST['date']))->getTimestamp();
	$dateFibST=DateTime::createFromFormat("Y-m-d", "2023-03-01")->getTimestamp();
	$daysDiff=round(($dateTS-$dateFibST) / (60 * 60 * 24));
	$out = "";
    for ($i = 0; $i < count($wares_array); $i++) {
		$out = $out."<tr><td>".htmlspecialchars($wares_array[$i]['name'], ENT_QUOTES)."</td>";
		// random or fibonacci
		if ($wares_array[$i]['name']=="Левый носок") {
			$out = $out."<td>".fibonacci($daysDiff)."</td>";
		} else { // random 0...100
			$out = $out."<td>".rand(0,100)."</td>";
		}
		$out = $out."<td>".$wares_array[$i]['remainder']."</td>";
		$out = $out."<td>".$wares_array[$i]['costprice']."</td>";
		$out = $out."<td>".$wares_array[$i]['costprice']+0.3*$wares_array[$i]['costprice']."</td></tr>";
			
	}

    return $out;
}

?>




   


<!DOCTYPE html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>abcAge - Склад</title>


<style>
.tasktable table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

.tasktable td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.tasktable tr:nth-child(even) {
  background-color: #dddddd;
}
</style>


</head>
<body onload="">


<?php

?>


<h2>abcAge - Склад</h2>
<h3>Здравствуйте, СОС!</h3>

<form action="" method="post">
    


<table>
<tr>
    <td>Выберите дату:</td><td><input type="datetime-local" name="date"></td>
    <td><input type="submit" name="datesub" value="Ок"></td>
</tr>
</table>


<?php 
if (isset($_POST['date'])) {
	echo "Данные для ".$_POST['date'];
}
?>

<table class="tasktable">
  <tr>
    <th>Наименование</th>
    <th>Заказ</th>
    <th>Остаток на складе</th>
    <th>Себестоимость</th>
    <th>Цена</th>
  </tr>
 
 
<?php 
if (isset($_POST['date'])) {
	echo printData($conn); 
}
?>
 

</table>


</form>

<?php 			
	CloseCon($conn);
?>

</body>
</html>