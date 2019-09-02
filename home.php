<div class="half" style="vertical-align:top;">
      <h1>預告片介紹</h1>
      <div class="rb tab" style="width:95%;">
        <div id="abgne-block-20111227">
        <div style="height:300px" class="ct">
        <img class="show" id="showimg" style="height:250px"><br>
        <span class="show" id="showtext"></span>
        </div>
        <div style="height:100px" class="ct">
        <?
        $ani=q("select * from ani")[0][0];
        $total=count(q("select * from pos where sh='1'"));
        if($total>4){
          ?>
            <img src="./img/up.jpg" onclick="pp(1)">
          <?
        }
        $pos=q("select * from pos where sh='1' order by rank");
        foreach($pos as $k=>$p){
        ?>
          <img src="./img/<?=$p['file']?>"  style="width:80px;height:103px" class="im" id="ssaa<?=$k?>" onclick="ani(<?=$k?>)">
          <span id="text<?=$k?>" style="display:none"><?=$p['name']?></span>
        <?
         }
        if($total>4){
          ?>
            <img src="./img/dn.jpg" onclick="pp(2)">
          <?
        }

        ?>
                               <script>
                        	var nowpage=0,num=<?=$total?>;
							function pp(x)
							{
								var s,t;
								if(x==1&&nowpage-1>=0)
								{nowpage--;}
								if(x==2&&(nowpage+1)<=num-4)
								{nowpage++;}
								$(".im").hide()
								for(s=0;s<=3;s++)
								{
									t=s*1+nowpage*1;
									$("#ssaa"+t).show()
								}
							}
							pp(1)
                        </script>
        </div>
        </div>
      </div>
    </div>
    <div class="half">
      <h1>院線片清單</h1>
      <div class="rb tab" style="width:95%;">
        <table style="margin:auto;">
          <tbody>
          <?  
          $today=date("Y-m-d");
          $startday=date("Y-m-d",strtotime("-2 days"));
          $all=count(q("select * from movie where sh='1' and ondate>='$startday' and ondate<='$today'"));  
          $div=4;
          $page=ceil($all/$div);
          $now=(!empty($_GET['p']))?$_GET['p']:1;
          $start=($now-1)*$div;
          $mov=q("select * from movie where sh='1' and ondate>='$startday' and ondate<='$today' order by rank limit $start,$div");
          $i=1;
          foreach($mov as $k=>$m){
          if($i%2==1) echo "<tr>";
          ?>
          <td style="background:none;border-radius:10%;border:1px solid white;color:white;padding:10px;"><img src="./movie/<?=$m['poster']?>" style="width:65px">
        <div style="float:right;"><?=$m['name']?><br>
      分級:<img src="./img/<?=$m['level']?>.png"><?=$level[$m['level']]?><br>
    <span style="font-size:12px;">上映日期:<?=date("Y/m/d",strtotime($m['ondate']))?></span><br> </div>
<div class="ct"><button onclick="lof('?do=movie&id=<?=$m['id']?>')">劇情簡介</button> 
<button onclick="lof('?do=ord&id=<?=$m['id']?>')">線上訂票</button>
</div>
  
 
  
  
  
  </td>
          <?
          if($i%2==0) echo "</tr>";
          $i++;


          }

          ?>
          <tr>
            <td colspan="2" style="background:none;color:white" class="ct">
<?
if(($now-1)>0){
  echo "<a href='?p=".($now-1)."'>&lt;</a>";
}
for($i=1;$i<=$page;$i++){
  if($now==$i){
    echo "<a href='?p=$i'><span style='font-size:24px'>$i</span></a>";
  }else{
    echo "<a href='?p=$i'>$i</a>";
  }
}
if(($now+1)<=$page){
  echo "<a href='?p=".($now+1)."'>&gt;</a>";
}



?>
            </td>
          </tr>
          </tbody>
        </table>
        <div class="ct"> </div>
      </div>
    </div>

    <script>
    let anim=<?=$ani?>;
    let total=<?=$total?>;
    let po=-1;
    auto();
    setInterval(auto,3500);
    function auto(){
      po++;
      if(po>=total) po=0;
      ani(po)
    }
    function ani(po){
      if(anim==1) $(".show").fadeOut(function(){change(po)})
      else if(anim==2) $(".show").slideToggle(function(){change(po)})
      else if(anim==3) $(".show").slideDown(function(){change(po)})
      if(anim==1) $(".show").fadeIn()
      else if(anim==2) $(".show").slideToggle()
      else if(anim==3) $(".show").slideUp()
    }
    function change(p){
      $("#showimg").attr("src",$("#ssaa"+p).attr("src"));
      $("#showtext").text($("#text"+p).text());
      po=p;
    }
    
    
    </script>