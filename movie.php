<?
$mov=find('movie',$_GET['id']);
?>
    <div class="tab rb" style="width:87%;">
      <div style="background:#FFF; width:100%; color:#333; text-align:left">
        <video src="movie/<?=$mov['trailer']?>" width="300px" height="250px" controls="" style="float:right;"></video>
        <font style="font-size:24px"> <img src="./movie/<?=$mov['poster']?>" width="200px" height="250px" style="margin:10px; float:left">
        <p style="margin:3px">影片名稱 ：<?=$mov['name']?>
          <input type="button" value="線上訂票" onclick="lof(&#39;?do=ord&id=<?=$_GET['id']?>&#39;)" style="margin-left:50px; padding:2px 4px" class="b2_btu">
        </p>
        <p style="margin:3px">影片分級 ： <img src="./img/<?=$mov['level']?>.png" style="display:inline-block;"><?=$level[$mov['level']]?></p>
        <p style="margin:3px">影片片長 ： <?=$mov['length']?>分鐘</p>
        <p style="margin:3px">上映日期 ：<?=date("Y/m/d",strtotime($mov['ondate']))?></p>
        <p style="margin:3px">發行商 ： <?=$mov['publish']?></p>
        <p style="margin:3px">導演 ：<?=$mov['director']?> </p>
        <br>
        <br>
        <p style="margin:10px 3px 3px 3px; word-break:break-all"> 劇情簡介：<br><?=$mov['text']?>
        </p>
        </font>
        <table width="100%" border="0">
          <tbody>
            <tr>
              <td align="center"><input type="button" value="院線片清單" onclick="lof(&#39;index.php&#39;)"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
