<?
// $pdo=new PDO("mysql:host=localhost;charset=utf8;dbname=web15-3-1","root","");
$pdo=new PDO("mysql:host=localhost;charset=utf8;dbname=s1080115","s1080115","s1080115");
localhost:http://220.128.133.15/s1080115/;
session_start();
$level=[
1=>'普遍級',
2=>'保護級',
3=>'輔導級',
4=>'限制級',
];

$time=[
14=>'14:00~16:00',
16=>'16:00~18:00',
18=>'18:00~20:00',
20=>'20:00~22:00',
22=>'22:00~24:00',
];

function all($table,$data){
  global $pdo;
  if(is_array($data)){
    foreach($data as $k=>$v){
      $str[]=sprintf("%s='%s'",$k,$v);
    }
    $sql="select * from $table where ".implode(" && ",$str)."";
  }else{
    $sql="select * from $table";
  }
return $pdo->query($sql)->fetchAll();
}

function find($table,$data){
  global $pdo;
  if(is_array($data)){
    foreach($data as $k=>$v){
      $str[]=sprintf("%s='%s'",$k,$v);
    }
    $sql="select * from $table where ".implode(" && ",$str)."";
  }else{
    $sql="select * from $table where id='$data'";
  }
return $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

function del($table,$data){
  global $pdo;
  if(is_array($data)){
    foreach($data as $k=>$v){
      $str[]=sprintf("%s='%s'",$k,$v);
    }
    $sql="delete from $table where ".implode(" && ",$str)."";
  }else{
    $sql="delete from $table where id='$data'";
  }
return $pdo->exec($sql);
}

function save($table,$data){
  global $pdo;
  if(!empty($data['id'])){
    foreach($data as $k=>$v){
      if($k !='id'){
        $str[]=sprintf("%s='%s'",$k,$v);

      }
    }
    $sql="update $table set ".implode(" , ",$str)." where id='".$data['id']."'";
    // echo "update $table set ".implode(" , ",$str)." where id='".$data['id']."'";
  }else{
    $sql="insert into $table (`".implode("`,`",array_keys($data))."`) values ('".implode("','",$data)."');";
    // echo "insert into $table (`".implode("`,`",array_keys($data))."`) values ('".implode("','",$data)."');";
  }
return $pdo->exec($sql);
}

function nums($table,$data){
  global $pdo;
  if(is_array($data)){
    foreach($data as $k=>$v){
      $str[]=sprintf("%s='%s'",$k,$v);
    }
    $sql="select count(*) from $table where ".implode(" && ",$str)."";
  }else{
    $sql="select count(*) from $table";
  }
return $pdo->query($sql)->fetchColumn();
}

function to($p){
header("location:$p");
}
function q($str){
  global $pdo;
  return $pdo->query($str)->fetchAll();
}


?>