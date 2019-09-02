<style>
.all{
  background:url("./img/03D04.png") no-repeat;
  background-size:550px 385px;
  height:380px;
}
table{
padding-top:15px;
padding-left:110px;
}
td{
  border:1px solid white;
}
</style>

<div class="all">
<table>
<?
$id=$_GET['id'];
$name=$_GET['name'];
$indate=$_GET['indate'];
$time=$_GET['time'];
$j=1;
$seat=[];
for($i=0;$i<20;$i++){
if(($j%5)==1) echo "<tr>";
$ord=all('ord',['name'=>$name,'indate'=>$indate,'time'=>$time]);
foreach($ord as $o){
$seat=array_merge($seat,unserialize($o['seat']));
}
if(in_array($i,$seat)){
  ?>
<td style="background:none;">
<?
echo ceil(($i+1)/5) ."排". (($i%5)+1) . "號<br>";
?>
<img src="./img/03D03.png" alt=""></td>
  <?
}else{


?>

<td style="background:none;">
<?
echo ceil(($i+1)/5) ."排". (($i%5)+1) . "號<br>";
?>
<img src="./img/03D02.png" alt=""><input type="checkbox" name="no" class="chk" value="<?=$i?>" id="no<?=$i?>"></td>

<?
}
if(($j%5)==0) echo "</tr>";
$j++;


}
?>
</table>
</div>
<div style="padding-left:110px;">您選擇的電影是:<?=$name?><br>
您選擇的時刻是:<?=$time?><br>
您已經勾選了<span id="tit"></span>張票，最多可以購買四張票<br>
<button onclick="lof('?do=ord&id=<?=$id?>&name=${name}&indate=${indate}&time=${time}')">上一步</button>
<button onclick="chkout()">完成訂購</button>
</div>
<script>
let seat=new Array;
let qt=0;
$(".chk").on("change",function(){
  let val=$(this).val()
  let status=$(this).prop("checked")
if(status==true){
  qt++
  if(qt>4){
    qt--
    $(this).prop("checked",false)
  }else{
    seat.push(val)
  }
}else{
  qt--
  seat.splice(seat.indexOf(val),1)
}
$("#tit").text(qt)
})

function chkout(){
  let name="<?=$name?>";
  let indate="<?=$indate?>";
  let time="<?=$time?>";
  $.post("api.php?do=chkout",{name,indate,time,seat,qt},function(no){
    lof(`?do=chkout&name=${name}&indate=${indate}&time=${time}&seat=${seat}&qt=${qt}&no=${no}`)
  })
}


</script>