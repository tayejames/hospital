<!-- <?php
/*$serial1 = get_serial_num(12);

//Serial # function
function get_serial_num($number_cnt){
 $ret_arr = array();
 $serial = "";
 $ser_num = array("1","2","3","4","5","6","7","8","9","0","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
 for($i = 0; $i < $number_cnt; $i++){
   $rand = rand(0,count($ser_num)-1);
   $val = wordwrap($ser_num[$rand],1,"\n", true);
   $serial .= $val;
   
 }
 return $serial;
}
echo ''.$serial1.'';*/
?> -->

<?php
$ddate = "2022-17-01";
$duedt = explode("-",$ddate);
$date = mktime(0, 0, 0, $duedt[2], $duedt[1],$duedt[0]);
$week = (int)date('W', $date);
echo "Weeknummer: ".$week . "<br>";
?>

<?php
$ddate = "2022-01-17";
$date = new DateTime($ddate);
$week = $date->format("W");
echo "Weeknummer: $week<br>";


$date_string = "2022-01-17";
echo "Weeknummer: " . date("W", strtotime($date_string));
?>

<!-- <?php
  
// for($i=0;$i<=100;$i++) {
// echo sprintf("%05d", $i) . "<br>";
//}

?> -->