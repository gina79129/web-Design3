<h3 class="ct">修改院線片</h3>
<hr>
<form action="api.php?do=editmovie" method="post" enctype="multipart/form-data">
<table style="margin:auto;">
<?
$mov=find('movie',$_GET['id']);
?>
  <tr>
    <td rowspan="8">影片資料</td>
    <td>片名:</td>
    <td><input type="text" name="name" value="<?=$mov['name']?>">
    <input type="hidden" name="id" value="<?=$_GET['id']?>"></td>
  </tr>
  <tr>
    <td>分級:</td>
    <td><select name="level" id="level">
    <?
    foreach($level as $k=>$l){
      $sel=($k==$mov['level'])?"selected":"";
    echo "<option value='$k' $sel>$l</option>";
    }
    
    ?>
    </select></td></tr>
  <tr>
    <td>片長:</td>
    <td><input type="text" name="length" value="<?=$mov['length']?>"></td>
  </tr>
  <tr>
    <td>上映日期:</td>
    <td><select name="year" id="year"><option value="<?=date("Y")?>"><?=date("Y")?></option></select>年
    <select name="month" id="month">
    <?
    $month=date("n",strtotime($mov['ondate']));
      for($i=1;$i<=12;$i++){
        $sel=($month==$i)?"selected":"";
        echo "<option value='$i' $sel>$i</option>";
      }
    ?>
    </select>月
    <select name="day" id="day">
    <?
    $day=date("j",strtotime($mov['ondate']));
      for($i=1;$i<=31;$i++){
        $sel=($day==$i)?"selected":"";
        echo "<option value='$i' $sel>$i</option>";
      }
    ?>
    </select>日</td>
  </tr>
  <tr>
    <td>發行商:</td>
    <td><input type="text" name="publish" value="<?=$mov['publish']?>"></td>
  </tr>
  <tr>
    <td>導演:</td>
    <td><input type="text" name="director" value="<?=$mov['director']?>"></td>
  </tr>
  <tr>
    <td>預告影片:</td>
    <td><input type="file" name="trailer"></td>
  </tr>
  <tr>
    <td>電影海報:</td>
    <td><input type="file" name="poster"></td>
  </tr>
  <tr>
    <td>劇情簡介</td>
    <td colspan="2"><textarea name="text" id="text" style="width:280px;height:100px"><?=$mov['text']?></textarea></td>
  </tr>
  <tr class="ct">
    <td colspan="3"><input type="submit" value="修改"><input type="reset" value="重置"></td>
  </tr>
</table>


</form>