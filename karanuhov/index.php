<?php

/*

Небольшое описание.

1. Любой пользователь может добавлять доставки.
2. Пользователь с именем администратора (имя пользователя - "admin" пароль - "123") может редактировать существующие доставки.
3. Пользователь - транспортная Компания (имя пользователя любое кроме "admin", регистрация ненужна, пароль - любой не пустой) может брать/удалять себе доставки из существующих.
4. Что требовалось - Соответственный список доставок для всех компаний или для одной, которая залогинина на данный момент в конце страницы.
5. База данных сделана с помощью 2-х текстовых файлов - bdostavka.txt - быстрая доставка и mdostavka.txt - медленная доставка. Каждая запись в новой строчке, в каждой строчке между полями разделитель "_,_".
   Добавил ещё одное поле к записям - владелец - owner - если какая-то компания взяла заказ, то он сохраняется в файле.
6. К каждой функции тоже небольшое описание.
7. Принципы ООП - классы - не использовал, но можно в принципе сднлать класс доставки и прописать все методы в классе.
Спасибо.
   

*/

session_start();

// логин / логаут обработка

function isLoggedIn() {
	if (!isset($_SESSION)) {
		session_start();
	}
	if ($_SESSION['login']=="OK") return $_SESSION['username'];
	return 0;
}



function logIn($username, $pass) {
	if ($username=="" || $pass=="") {logOut();return 0;}
    if ($username=="admin" && $pass=="123") {
	    if (!isset($_SESSION)) {
	    	session_start();
	    }
	    $_SESSION['login']="OK";
		$_SESSION['username']="admin";
	    return 1;
    } else {
		if (!isset($_SESSION)) {
	    	session_start();
	    }
		$_SESSION['login']="OK";
		$_SESSION['username']=$username;
	    return 1;
    }
}

function logOut() {
    if (!isset($_SESSION)) {
    	session_start();
    }
    $_SESSION['login']="";
	$_SESSION['username']="";
    return 1;
}


// чтение данных из файла, медленная доставка

function getDataM() {
    if (!file_exists("mdostavka.txt")) file_put_contents("mdostavka.txt","");
    $file_contents=file_get_contents("mdostavka.txt");
    if (empty($file_contents)) $file_contents="";
    return $file_contents;
}

// чтение данных из файла, быстрая доставка

function getDataB() {
    if (!file_exists("bdostavka.txt")) file_put_contents("bdostavka.txt","");
    $file_contents=file_get_contents("bdostavka.txt");
    if (empty($file_contents)) $file_contents="";
    return $file_contents;
}


// вывод данных, быстрая доставка
function printDataB() {
    $file_contents=getDataB();
    $lines=explode("\n", $file_contents);
    for ($i = 0; $i < count($lines)-1; $i++) {
        list($url, $from, $to, $weight, $price, $priod, $error, $owner) = explode("_;_", $lines[$i]);
		echo "<tr>";
        if (isLoggedIn() && isLoggedIn()=="admin") {
			echo "<td><input type='text' name='urlb".$i."' value='".$url."'></td>";
			echo "<td><input type='text' name='fromb".$i."' value='".$from."'></td>";
            echo "<td><input type='text' name='tob".$i."' value='".$to."'></td>";
            echo "<td><input type='text' name='weightb".$i."' value='".$weight."'></td>";
            echo "<td><input type='text' name='priceb".$i."' value='".$price."'></td>";
            echo "<td><input type='text' name='periodb".$i."' value='".$priod."'></td>";
            echo "<td><input type='text' name='errorb".$i."' value='".$error."'></td>";
        } else {
			echo "<td>".$url."</td><td>".$from."</td>"."</td><td>".$to."</td><td>".$weight."</td><td>".$price."</td><td>".$priod."</td><td>".$error."</td>";
        }
		if (isLoggedIn() && isLoggedIn()!="admin") {
			if (isLoggedIn()!=$owner) {
				echo "<td><input type='submit' name='takeb".$i."' value='Взять'></td>";
			} else {
				echo "<td><input type='submit' name='dropb".$i."' value='Удалить'></td>";
			}
		} else {
			echo "<td>".$owner."</td>";
		}
		echo "</tr>";
    }

    return $file_contents;
}

// вывод данных, медленная доставка
function printDataM() {
    $file_contents=getDataM();
    $lines=explode("\n", $file_contents);
    for ($i = 0; $i < count($lines)-1; $i++) {
        list($url, $from, $to, $weight, $coeff, $date, $error, $owner) = explode("_;_", $lines[$i]);
		
		echo "<tr>";
        if (isLoggedIn() && isLoggedIn()=="admin") {
			echo "<td><input type='text' name='urlm".$i."' value='".$url."'></td>";
			echo "<td><input type='text' name='fromm".$i."' value='".$from."'></td>";
            echo "<td><input type='text' name='tom".$i."' value='".$to."'></td>";
            echo "<td><input type='text' name='weightm".$i."' value='".$weight."'></td>";
            echo "<td><input type='text' name='coeffm".$i."' value='".$coeff."'></td>";
            echo "<td><input type='text' name='datem".$i."' value='".$date."'></td>";
            echo "<td><input type='text' name='errorm".$i."' value='".$error."'></td>";
        } else {
			echo "<td>".$url."</td><td>".$from."</td>"."</td><td>".$to."</td><td>".$weight."</td><td>".$coeff."</td><td>".$date."</td><td>".$error."</td>";
        }
		if (isLoggedIn() && isLoggedIn()!="admin") {
			if (isLoggedIn()!=$owner) {
				echo "<td><input type='submit' name='takem".$i."' value='Взять'></td>";
			} else {
				echo "<td><input type='submit' name='dropm".$i."' value='Удалить'></td>";
			}
		} else {
			echo "<td>".$owner."</td>";
		}
		echo "</tr>";
	}

    return $file_contents;
}



// вывод данных, транспортная компания/ии
function printDataTr() {
	
    $file_contents=getDataB();
    $lines=explode("\n", $file_contents);
    for ($i = 0; $i < count($lines)-1; $i++) {
        list($url, $from, $to, $weight, $price, $priod, $error, $owner) = explode("_;_", $lines[$i]);
		
		$periodi = (int)$priod;
		$dateUnix = strtotime("+".$periodi." day");
		$date = date("Y-m-d", $dateUnix);
		
		echo "<tr>";
		if (!isLoggedIn() || isLoggedIn()=="admin") {
			echo "<td>".$owner."</td><td>".$price."</td><td>".$date."</td>"."</td><td>".$error."</td>";
		} else {
			if ($owner==$_SESSION['username']) {
				echo "<td>".$price."</td><td>".$date."</td>"."</td><td>".$error."</td>";
			}
		}
		echo "</tr>";
	}

    $file_contents=getDataM();
    $lines=explode("\n", $file_contents);
    for ($i = 0; $i < count($lines)-1; $i++) {
        list($url, $from, $to, $weight, $coeff, $date, $error, $owner) = explode("_;_", $lines[$i]);
		
		$coefff = (float)$coeff;
		$price = (int)(150*$coefff);
		
		echo "<tr>";
		if (!isLoggedIn() || isLoggedIn()=="admin") {
			echo "<td>".$owner."</td><td>".$price."</td><td>".$date."</td>"."</td><td>".$error."</td>";
		} else {
			if ($owner==$_SESSION['username']) {
				echo "<td>".$price."</td><td>".$date."</td>"."</td><td>".$error."</td>";
			}
		}
		echo "</tr>";
	}


    return 1;
}


// добавление данных, быстрая доставка
function addDataB($url, $from, $to, $weight, $price, $priod, $error) {
    $file_contents=getDataB();
    file_put_contents("bdostavka.txt", $url."_;_".$from."_;_".$to."_;_".$weight."_;_".$price."_;_".$priod."_;_".$error."_;_\n".$file_contents);
}

// добавление данных, медленная доставка
function addDataM($url, $from, $to, $weight, $coeff, $date, $error) {
    $file_contents=getDataM();
    file_put_contents("mdostavka.txt", $url."_;_".$from."_;_".$to."_;_".$weight."_;_".$coeff."_;_".$date."_;_".$error."_;_\n".$file_contents);
}


// обновление данных, быстрая/медленная доставка
function saveData() {
	
    $file_contents=getDataB();
    $lines=explode("\n", $file_contents);
    $out="";
    for ($i = 0; $i < count($lines)-1; $i++) {
		list($url, $from, $to, $weight, $coeff, $date, $error, $owner) = explode("_;_", $lines[$i]);
        $out=$out.$_POST['urlb'.$i]."_;_".$_POST['fromb'.$i]."_;_".$_POST['tob'.$i]."_;_".$_POST['weightb'.$i]."_;_".$_POST['priceb'.$i]."_;_".$_POST['periodb'.$i]."_;_".$_POST['errorb'.$i]."_;_".$owner."\n";
    }
    file_put_contents("bdostavka.txt", $out);

	
	
    $file_contents=getDataM();
    $lines=explode("\n", $file_contents);
    $out="";
    for ($i = 0; $i < count($lines)-1; $i++) {
		list($url, $from, $to, $weight, $coeff, $date, $error, $owner) = explode("_;_", $lines[$i]);
        $out=$out.$_POST['urlm'.$i]."_;_".$_POST['fromm'.$i]."_;_".$_POST['tom'.$i]."_;_".$_POST['weightm'.$i]."_;_".$_POST['coeffm'.$i]."_;_".$_POST['datem'.$i]."_;_".$_POST['errorm'.$i]."_;_".$owner."\n";
    }
    file_put_contents("mdostavka.txt", $out);

}


// присвоение доставки к транспортной компании, быстрая доставка
function takeDostB($i2) {
    $file_contents=getDataB();
    $lines=explode("\n", $file_contents);
    $out="";
    for ($i = 0; $i < count($lines)-1; $i++) {
		list($url, $from, $to, $weight, $price, $priod, $error, $owner) = explode("_;_", $lines[$i]);
		if ($i==$i2) $owner=$_SESSION['username'];
        $out=$out.$url."_;_".$from."_;_".$to."_;_".$weight."_;_".$price."_;_".$priod."_;_".$error."_;_".$owner."\n";
    }
    file_put_contents("bdostavka.txt", $out);
}

// присвоение доставки к транспортной компании, медленная доставка
function takeDostM($i2) {
    $file_contents=getDataM();
    $lines=explode("\n", $file_contents);
    $out="";
    for ($i = 0; $i < count($lines)-1; $i++) {
		list($url, $from, $to, $weight, $coeff, $date, $error, $owner) = explode("_;_", $lines[$i]);
		if ($i==$i2) $owner=$_SESSION['username'];
        $out=$out.$url."_;_".$from."_;_".$to."_;_".$weight."_;_".$coeff."_;_".$date."_;_".$error."_;_".$owner."\n";
    }
    file_put_contents("mdostavka.txt", $out);
}


// удаление доставки от транспортной компании, быстрая доставка
function dropDostB($i2) {
    $file_contents=getDataB();
    $lines=explode("\n", $file_contents);
    $out="";
    for ($i = 0; $i < count($lines)-1; $i++) {
		list($url, $from, $to, $weight, $price, $priod, $error, $owner) = explode("_;_", $lines[$i]);
		if ($i==$i2) $owner="";
        $out=$out.$url."_;_".$from."_;_".$to."_;_".$weight."_;_".$price."_;_".$priod."_;_".$error."_;_".$owner."\n";
    }
    file_put_contents("bdostavka.txt", $out);
}

// удаление доставки от транспортной компании, медленная доставка
function dropDostM($i2) {
    $file_contents=getDataM();
    $lines=explode("\n", $file_contents);
    $out="";
    for ($i = 0; $i < count($lines)-1; $i++) {
		list($url, $from, $to, $weight, $coeff, $date, $error, $owner) = explode("_;_", $lines[$i]);
		if ($i==$i2) $owner="";
        $out=$out.$url."_;_".$from."_;_".$to."_;_".$weight."_;_".$coeff."_;_".$date."_;_".$error."_;_".$owner."\n";
    }
    file_put_contents("mdostavka.txt", $out);
}


?>




<!DOCTYPE html>

<html>

<head>
<title></title> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="shortcut icon" href="" type="image/ico" />

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

<body>

<?php

if (isset($_POST['logout'])) {
    logOut();
}

if (isset($_POST['login'])) {
    if (!empty($_POST['logusername']) && !empty($_POST['logpassword'])) {
        logIn($_POST['logusername'], $_POST['logpassword']);
    }
}

if (isset($_POST['addb'])) {
    addDataB($_POST['urlb'], $_POST['fromb'], $_POST['tob'], $_POST['weightb'], $_POST['priceb'], $_POST['priodb'], $_POST['errorb']);
}

if (isset($_POST['addm'])) {
    addDataM($_POST['urlm'], $_POST['fromm'], $_POST['tom'], $_POST['weightm'], $_POST['coeffm'], $_POST['datem'], $_POST['errorm']);
}



if (isset($_POST['save'])) {
    saveData();
}

foreach($_POST as $key => $value) {
    if (strstr($key, 'takeb')) {
		takeDostB(strstr($key, 'takeb'));
		break;
    }
    if (strstr($key, 'dropb')) {
		dropDostB(strstr($key, 'dropb'));
		break;
    }

    if (strstr($key, 'takem')) {
		takeDostM(strstr($key, 'takem'));
		break;
    }
    if (strstr($key, 'dropm')) {
		dropDostM(strstr($key, 'dropm'));
		break;
    }

}

?>



<h2>Приложение - Доставки</h2>

<form action="index.php" method="post">
    


<table>
<tr>
    <?php if (isLoggedIn()) {?>
        <td>Вы вошли как <b><?php echo $_SESSION['username']; ?></b>.</td><td><input type="submit" name="logout" value="Выход"></td>    
    <?php } else {?>
    <td>Имя Пользователя:</td><td><input type="text" name="logusername"></td>
    <td>Пароль:</td><td><input type="password" name="logpassword"></td>
    <td><input type="submit" name="login" value="Вход"></td>
    <?php }?>
</tr>
</table>


Быстрая Доставка:
<table>
<tr>
    <td>Url:</td><td><input type="text" name="urlb"></td>
    <td>Кладр Откуда:</td><td><input type="text" name="fromb"></td>
    <td>Кладр Куда:</td><td><input type="text" name="tob"></td>
	<td>Вес (кг):</td><td><input type="text" name="weightb"></td>
	<td>Цена:</td><td><input type="text" name="priceb"></td>
	<td>Кол-во дней:</td><td><input type="text" name="priodb"></td>
	<td>Комментарии:</td><td><input type="text" name="errorb"></td>
    <td><input type="submit" name="addb" value="Добавить Доставку"></td>
</tr>
</table>


Медленная Доставка:
<table>
<tr>
    <td>Url:</td><td><input type="text" name="urlm"></td>
    <td>Кладр Откуда:</td><td><input type="text" name="fromm"></td>
    <td>Кладр Куда:</td><td><input type="text" name="tom"></td>
	<td>Вес (кг):</td><td><input type="text" name="weightm"></td>
	<td>Цена - 150р, Коэфф.:</td><td><input type="text" name="coeffm"></td>
	<td>Дата Доставки (форм. 2017-10-20):</td><td><input type="text" name="datem"></td>
	<td>Комментарии:</td><td><input type="text" name="errorm"></td>
    <td><input type="submit" name="addm" value="Добавить Доставку"></td>
</tr>
</table>

<h2>Быстрые доставки:</h2>

<table class="tasktable">
  <tr>
    <th>Base Url</th>
    <th>Кладр Откуда</th>
    <th>Кладр Куда</th>
    <th>Вес (кг)</th>
    <th>Стоимость</th>
    <th>Кол-во дней</th>
    <th>Комментарии</th>
    <?php 
    if (isLoggedIn()&&isLoggedIn()!="admin") {
        echo "<th>Взять/Удалить</th>";
    } else {
        echo "<th>Владелец</th>";
    }
    ?>
  </tr>

  <?php printDataB(); ?>

</table>


<h2>Медленные доставки:</h2>

<table class="tasktable">
  <tr>
    <th>Base Url</th>
    <th>Кладр Откуда</th>
    <th>Кладр Куда</th>
    <th>Вес (кг)</th>
    <th>Стоимость - 150р, Коэфф.</th>
    <th>Дата Доставки</th>
    <th>Комментарии</th>
    <?php 
    if (isLoggedIn()&&isLoggedIn()!="admin") {
        echo "<th>Взять/Удалить</th>";
    } else {
        echo "<th>Владелец</th>";
    }

    ?>
	</tr>

  <?php printDataM(); ?>

</table>


  <?php 
    if (isLoggedIn()=="admin") {
        echo "<input type='submit' name='save' value='Сохранить'>";
    }
  ?>


</form>


    <?php 
    if (isLoggedIn()&&isLoggedIn()!="admin") {
        echo "<h2>Доставки Компании ".$_SESSION['username'].":</h2>";
    } else {
        echo "<h2>Доставки по Компании:</h2>";
    }

    ?>



<table class="tasktable">
  <tr>
    <?php 
		if (!isLoggedIn() || isLoggedIn()=="admin") {
			echo "<th>Компания</th>";
		}
	?>
    <th>Стоимость</th>
    <th>Дата Доставки</th>
    <th>Комментарии</th>
   </tr>

  <?php printDataTr(); ?>

</table>



</body>
</html>



