<?php
	include("conn.php");
	
	$str = "6,78,5,6,920";
	$strArr = explode(",", $str);
	var_dump($strArr);
	echo "<br>";

	$num = 5;
	var_dump($num);
	echo "<br>";
	if(($key = array_search($num, $strArr)) !== false) {
		echo "string and number insensitive<br>";
	} else {
		echo "string and number sensitive<br>";
	}

	$te = "6";
	$teArr = explode(",", $te);
	var_dump($teArr);
	print_r($teArr);
	echo "<br>";

	/*本测试循环中有exit()。未避免影响下面的测试，故注解掉。
	$arr = array(5, 98, 146, 78, 3);
	foreach($arr as $a) {
		if($a != 146) {
			echo $a.",";
		} else {
			echo "I am 146!";
			exit();
		}
	}
	*/
	
	$str1 = "";
	var_dump($str1);
	$str1Arr = explode(",", $str1);
	var_dump($str1Arr);
	$mem = 1;
	$mm = in_array($mem, $str1Arr) ? 1 : 0;
	echo $mm;
	echo "<br>";
	echo $aaa = !empty($str1Arr) ? "只有一个空字符的数组不算空<br>" : "只有一个空字符的数组算空<br>";
	$arrB = array();
	echo $bbb = !empty($arrB) ? "空数组不算空<br>" : "空数组算空<br>";
	$arrBStr = implode(",", $arrB);
	var_dump($arrBStr);
	echo "<br>";
	echo $arrBStr."hereiam<br>";


	echo "kakakakakakaka<br>";
	$a = array(4,5,6,7,8);
	$b = array_search(6, $a);
	var_dump($b);
	echo "<br>";
	unset($a[$b]);
	var_dump($a);
	echo "<br>";

	
	$strArr[] = 2018;
	print_r($strArr);
	echo "<br>";

	$str2 = "";
	if (!empty($str2)) {
		echo "Blank is not empty by using empty()<br>";
	} else {
		echo "Blank is empty by using empty()<br>";
	}

	if ($str2) {
		echo "Blank is not empty as a condition<br>";
	} else {
		echo "Blank is empty as a condition<br>";
	}

	$str3 = "a";
	$str3Arr = explode(",", $str3);
	var_dump($str3Arr);
	echo "<br>";

	$arr1 = array();
	var_dump($arr1);
	echo "<br>";
	$arr1Str = implode(",", $arr1);
	var_dump($arr1Str);
	echo "<br>";
?>