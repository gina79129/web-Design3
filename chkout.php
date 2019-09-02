感謝您的訂購，您的訂單編號是:<?=$_GET['no']?><br>
電影名稱:<?=$_GET['name']?><br>
日期:<?=date("Y/m/d",strtotime($_GET['indate']))?><br>
場次時間:<?=$_GET['time']?><br>
座位:<br>
<?
$seat=explode(",",$_GET['seat']);
sort($seat);
foreach($seat as $i){
  echo ceil(($i+1)/5) ."排". (($i%5)+1) . "號<br>";

}

?>
<div><button onclick="lof('index.php')">確認</button></div>
