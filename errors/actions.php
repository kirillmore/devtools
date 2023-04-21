<?
include("../../_kernel/_kernel.php");
$a=$_GET['a'];
$line=$_GET['line'];

function deleteLineFromFile($filename, $lineToDelete){
  $n=1;
  $file=fopen($filename, "r");
  $tempFile=fopen("../../../logs/php_error.tmp", "w");
  while(!feof($file)){
    $line=fgets($file);
    if($lineToDelete!=$n){
      fwrite($tempFile, $line);
    }
    $n++;
  }
  fclose($file);
  fclose($tempFile);
  unlink($filename);
  rename("../../../logs/php_error.tmp", $filename);
}

function deleteLineFromFileSameStrings($filename, $lineToDelete){


  $file=fopen($filename, "r");
  $tempFile=fopen("../../../logs/php_error.tmp", "w");
  while(!feof($file)){
    $line=fgets($file);

    // $mystring = 'abc';
    // $findme   = 'a';
    $pos = strpos($line, $lineToDelete);
    if ($pos === false) {
      fwrite($tempFile, $line);
      echo "Строка ".$lineToDelete." не найдена в строке ".$line."\n";
    } else {
      echo "Строка ".$lineToDelete." найдена в строке ".$line."\n";
    }
  }
  fclose($file);
  fclose($tempFile);
  unlink($filename);
  rename("../../../logs/php_error.tmp", $filename);

}

if($a=='del'){
  deleteLineFromFile("../../../logs/php_error.log", $line);
  changeLocation('index.php');
}

if($a=='delSame'){
  deleteLineFromFileSameStrings("../../../logs/php_error.log", $line);
  changeLocation('index.php');
}

?>