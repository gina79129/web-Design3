<?
include "base.php";
$do=(!empty($_GET['do']))?$_GET['do']:"";
switch($do){
  case "newpos":
  if(!empty($_FILES['file']['tmp_name'])){
    $data['file']=$_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'],"./img/".$data['file']);
  }
  $data['name']=$_POST['name'];
  $data['rank']=q("select max(`rank`) from pos")[0][0]+1;
  save('pos',$data);
  to("admin.php?do=rr");
  break;

  case "editpos":
  // print_r($_POST['id']);
  q("update ani set ani='".$_POST['ani']."'");
  foreach($_POST['id'] as $k=>$id){
    // echo $id;
    if(!empty($_POST['del']) && in_array($id,$_POST['del'])){
      del('pos',$id);
    }else{
      $pos=find('pos',$id);
      print_r($pos);
      $pos['sh']=(in_array($id,$_POST['sh']))?"1":"0";
      $pos['name']=$_POST['name'][$k];
      save('pos',$pos);
    }
  }

  to("admin.php?do=rr");
  break;

  case "sw":
  $table=$_POST['table'];
  $id1=$_POST['id1'];
  $id2=$_POST['id2'];
  $data1=find($table,$id1);
  $data2=find($table,$id2);
  $chg=$data1['rank'];
  $data1['rank']=$data2['rank'];
  $data2['rank']=$chg;
  save($table,$data1);
  save($table,$data2);
  break;

  case "show":
  $show=find('movie',$_POST['id']);
  $show['sh']=($show['sh']+1)%2;
  save('movie',$show);
  break;

  case "newmovie":
  if(!empty($_FILES['trailer']['tmp_name'])){
    $data['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"./movie/".$data['trailer']);
  }
  if(!empty($_FILES['poster']['tmp_name'])){
    $data['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"./movie/".$data['poster']);
  }
  $data['rank']=q("select max(`rank`) from movie")[0][0]+1;
  $data['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];

  foreach($_POST as $k=>$v){
    switch($k){
      case "year":
      case "month":
      case "day":
      case "trailer":
      case "poster":
      break;
      default:
      $data[$k]=$v;
    }
  }
  save('movie',$data);
  to("admin.php?do=vv");
  break;

  case "editmovie":
  $data=find('movie',$_POST['id']);
  if(!empty($_FILES['trailer']['tmp_name'])){
    $data['trailer']=$_FILES['trailer']['name'];
    move_uploaded_file($_FILES['trailer']['tmp_name'],"./movie/".$data['trailer']);
  }
  if(!empty($_FILES['poster']['tmp_name'])){
    $data['poster']=$_FILES['poster']['name'];
    move_uploaded_file($_FILES['poster']['tmp_name'],"./movie/".$data['poster']);
  }
  $data['ondate']=$_POST['year']."-".$_POST['month']."-".$_POST['day'];

  foreach($_POST as $k=>$v){
    switch($k){
      case "year":
      case "month":
      case "day":
      case "trailer":
      case "poster":
      break;
      default:
      $data[$k]=$v;
    }
  }
  save('movie',$data);
  to("admin.php?do=vv");
  break;

  case "del":
  del($_POST['table'],$_POST['id']);
  break;

  case "chkout":
  // print_r($_POST);
  foreach($_POST as $k=>$v){
    switch($k){
      case "seat":
      break;
      default:
      $data[$k]=$v;
      break;
    }
  }
  $maxid=q("select max(`id`) from ord")[0][0]+1;
  $data['no']=date("Ymd").sprintf("%04d",$maxid);
  echo $data['no'];
  $data['seat']=serialize($_POST['seat']);
  save('ord',$data);
  break;

  case "qdel":
  $type=$_POST['type'];
  switch($type){
    case "1":
    del('ord',['indate'=>$_POST['str']]);
    break;
    case "2":
    del('ord',['name'=>$_POST['str']]);
    break;
  }
  break;
}

?>
