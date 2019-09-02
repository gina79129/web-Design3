<div style="height:300px;overflow:auto;">
<form action="api.php?do=editpos" method="post">
  <h3>輪播動畫</h3>
  <select name="ani" id="ani">
<option value="1">淡入淡出</option>
<option value="2">滑入滑出</option>
<option value="3">放大縮小</option>
  </select>
  <h3 class="ct">預告片清單</h3>
<table style="width:100%;margin:auto" class="ct">
  <tr>
    <td>預告片海報</td>
    <td>預告片片名</td>
    <td>預告片排序</td>
    <td>操作</td>
  </tr>
  <?
  $pos=q("select * from pos order by rank");
  foreach($pos as $k=>$p){
  ?>
  <tr>
    <td><img src="./img/<?=$p['file']?>" style="width:80px;height:103px;"></td>
    <td><input type="text" name="name[]" value="<?=$p['name']?>">
    <input type="hidden" name="id[]" value="<?=$p['id']?>"></td>
    <td>
      <button onclick="sw('pos',<?=$p['id']?>,<?=(($k-1)>=0)?$pos[$k-1]['id']:$p['id'];?>)">往上</button>
      <button onclick="sw('pos',<?=$p['id']?>,<?=(($k+1)<=count($pos)-1)?$pos[$k+1]['id']:$p['id'];?>)">往下</button>

    </td>
    <td>
    <input type="checkbox" name="sh[]" value="<?=$p['id']?>" <?=($p['sh']==1)?"checked":"";?>>顯示
    <input type="checkbox" name="del[]" value="<?=$p['id']?>">刪除

    </td>
  </tr>
  <?
     
    }
  ?>
</table>
</div>
<div class="ct"><input type="submit" value="編輯確定"><input type="reset" value="重置"></div>
</form>

<div style="height:150px">
<hr>
<h3 class="ct">新增預告片海報</h3>
<form action="api.php?do=newpos" method="post" enctype="multipart/form-data">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;預告片海報:<input type="file" name="file">&nbsp;&nbsp;&nbsp;&nbsp;預告片片名:<input type="text" name="name">
<div class="ct"><input type="submit" value="新增"><input type="reset" value="重置"></div>

</form>

</div>