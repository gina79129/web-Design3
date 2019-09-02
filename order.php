<h3 class="ct">訂單清單</h3>
<div class="ct">
快速刪除:
<input type="radio" name="type" value="1" checked>依日期<input type="text" name="date" id="date">
<input type="radio" name="type" value="2">依電影<select name="movie" id="movie">
<?
$ord=q("select * from ord group by name");
foreach($ord as $o){
  echo "<option value='".$o['name']."'>".$o['name']."</option>";
}
?>
</select>
<button onclick="qdel()">刪除</button>
<table class="ct" width="100%">
  <tr>
    <td>訂單編號</td>
    <td>電影名稱</td>
    <td>日期</td>
    <td>場次時間</td>
    <td>訂購數量</td>
    <td>訂購位置</td>
    <td>操作</td>
  </tr>
  <?
  $ord=q("select * from ord order by no");
  foreach($ord as $o){
    $seat=unserialize($o['seat']);
    sort($seat)
?>
<tr>
  <td><?=$o['no']?></td>
  <td><?=$o['name']?></td>
  <td><?=date("Y/m/d",strtotime($o['indate']))?></td>
  <td><?=$o['time']?></td>
  <td><?=$o['qt']?></td>
  <td>
  <?
foreach($seat as $i){
  echo ceil(($i+1)/5) ."排". (($i%5)+1) . "號<br>";
}
  ?>
  </td>
  <td><button onclick="del('ord',<?=$o['id']?>)">刪除</button></td>
</tr>

    <?
  }
  ?>
</table>
</div>
<script>
function qdel(){
let str="";
let chk;
let type=$("input[name='type']:checked").val()
console.log(type)
switch(type){
  case "1":
  str=$("#date").val()
  chk=confirm("您確定要刪除"+str+"的全部資料嗎?")
  break;
  case "2":
  str=$("#movie").val()
  chk=confirm("您確定要刪除"+str+"的全部資料嗎?")
  break;
}
if(chk==true){
  $.post("api.php?do=qdel",{str,type},function(){
    location.reload();
  })
}
}

</script>