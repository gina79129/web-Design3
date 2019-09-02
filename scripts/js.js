function del(table,id){
  $.post("api.php?do=del",{table,id},function(){
    location.reload();
  })
}

function show(id){
  $.post("api.php?do=show",{id},function(){
    location.reload();
  })
}
function sw(table,id1,id2){
  $.post("api.php?do=sw",{table,id1,id2},function(){
    location.reload();
  })
}
function lof(x){
location.href=x;
}
