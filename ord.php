<?
if(!empty($_GET['id'])){
  $id=$_GET['id'];
}else{
  $id=0;
}
if(!empty($_GET['indate'])){
  $getdate=$_GET['indate'];
}else{
  $getdate=date("Y-m-d");
}
if(!empty($_GET['time'])){
  $gettime=$_GET['time'];
}else{
  $gettime=date("G");
}

?>
<h3 class="ct">線上訂票</h3>
<hr>
<table style="margin:auto;">
  <tr>
    <td>電影:</td>
    <td><select name="movie" id="movie" onchange="datachange(1)">
    <?
    $today=date("Y-m-d");
    $startday=date("Y-m-d",strtotime("-2 days"));
    $mov=q("select * from movie where sh='1' and ondate>='$startday' and ondate<='$today'"); 
    foreach($mov as $m){
      $sel=($id==$m['id'])?"selected":"";
      echo "<option value='".$m['id']."' $sel>".$m['name']."</option>";
    }

    ?>
    
    </select></td>
  </tr>
  <tr>
    <td>日期:</td>
    <td><select name="indate" id="indate" onchange="datachange(2)">
    <?
    if(!empty($id)){
      $first=find('movie',$id);
    }else{
      $first=$mov[0];
    }
      $today=strtotime("today");

      $f_ondate=strtotime($first['ondate']);
      // echo $f_ondate;
      for($i=0;$i<3;$i++){
        $show_ondate=strtotime("+$i days",$f_ondate);
        // echo $show_ondate;
        if($show_ondate>=$today){  
        $sel=(date("Y-m-d",$show_ondate)==$getdate)?"selected":"";
        echo "<option value='".date("Y-m-d",$show_ondate)."' $sel>".date("m月 d日 l",$show_ondate)."</option>";
      }
      }

    ?>
    
    </select></td>
  </tr>
  <tr>
    <td>場次:</td>
    <td><select name="time" id="time"  onchange="datachange(3)">
    <?
    $nowday=date("Y-m-d");
    $nowtime=date("G");
    foreach($time as $k=>$t){
      $booked=20-q("select sum(`qt`) from ord where name='".$first['name']."' and indate='$getdate' and time='$t'")[0][0];
      $sel=($t==$gettime)?"selected":"";
      if($nowday<$getdate){
        echo "<option value='$t' $sel>$t 剩餘座位$booked</option>";
      }else{
        if($nowtime<$k){
          echo "<option value='$t' $sel>$t 剩餘座位$booked</option>";
        }
      }
    }


      ?>
    </select></td>
  </tr>
  <tr class="ct">
    <td colspan="2"><input type="button" value="確定" onclick="seat()"><input type="reset" value="重置"></td>
  </tr>
</table>
<script>
function datachange(x){
  let id=$("#movie").val();
  let indate=$("#indate").val();
  let time=$("#time").val();
  let urlStr=location.href.replace(location.search,'');
  urlStr+="?do=ord&id="+id;
  if(x>=2){
    urlStr+="&indate="+indate;
  }
  if(x>=3){
    urlStr+="&time="+time;
  }
  window.location.replace(urlStr);
}
function seat(){
  let id=$("#movie").val();
  let name=$("#movie option:selected").text()
  // console.log(name)
  let indate=$("#indate").val();
  let time=$("#time").val();
 lof(`?do=seat&id=${id}&name=${name}&indate=${indate}&time=${time}`)
}
</script>