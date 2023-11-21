<?
function addTags($s){
  //подсветка ошибок
  $s=str_replace('PHP Notice:','<span class="bg-warning">PHP Notice:</span>',$s);
  $s=str_replace('PHP Parse error:','<span class="bg-danger">PHP Parse error:</span>',$s);
  $s=str_replace('PHP Fatal error:','<span class="bg-danger">PHP Fatal error:</span>',$s);
  $s=str_replace('PHP Warning:','<span class="bg-danger">PHP Warning:</span>',$s);
  $s=str_replace('PHP Deprecated:','<span class="bg-danger">PHP Deprecated:</span>',$s);
  $s=str_replace(' Europe/Moscow','',$s);
  $s=str_replace(' UTC','',$s);
  return $s;
}

function countLines($file){
  //количество строк в файле
  if(!file_exists($file))exit("Файл не найден");    
  $file_arr=file($file); 
  $lines=count($file_arr); 
  return $lines; 
}

function sameLine($s) {
  if (mb_substr($s,0,1)=='[') {
    return mb_strcut($s, 37);
  }
  else {
    return urlencode($s);
  }
}
?>