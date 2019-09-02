<div style="height:400px;overflow:auto;">
<button onclick="lof('?do=newmovie')">新增電影</button>
<hr>
<table style="width:100%;margin:auto;" class="ct">
<?
$mov=q("select * from movie order by rank");
foreach($mov as $k=>$m){


?>
  <tr>
    <td><img src="./movie/<?=$m['poster']?>" style="width:80px;height:103jpx;"></td>
    <td>分級:<img src="./img/<?=$m['level']?>.png"></td>
    <td>
    <ul style="display:flex;list-style-type:none;padding:0;margin:0;">
      <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;片名:<?=$m['name']?></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <li>片長:<?=$m['length']?></li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <li>上映時間:<?=date("Y/m/d",strtotime($m['ondate']))?></li>
    </ul>
    <button onclick="show(<?=$m['id']?>)"><?=($m['sh']==1)?"顯示":"隱藏";?></button>
    <button onclick="sw('movie',<?=$m['id']?>,<?=(($k-1)>=0)?$mov[$k-1]['id']:$m['id'];?>)">往上</button>
      <button onclick="sw('movie',<?=$m['id']?>,<?=(($k+1)<=count($mov)-1)?$mov[$k+1]['id']:$m['id'];?>)">往下</button>
    <button onclick="lof('?do=editmovie&id=<?=$m['id']?>')">編輯電影</button>
    <button onclick="del('movie',<?=$m['id']?>)">刪除電影</button>
    <div>劇情簡介:<?=$m['text']?></div>
    </td>
  </tr>
  <?
  }
  ?>
</table>
</div>