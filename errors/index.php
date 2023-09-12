<?
include('functions.php');
$path="../../../logs/php_error.log";
$file=file($path);
//$file=array_reverse($file);
?>
<!DOCTYPE html>
<html>
<head>
  <title>Error log</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#fff">
  <!--jquery-->
  <!-- <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script> -->
  <!--bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <!--less-->
  <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
  <div class="linestotal"><?=countLines($path);?></div>
<?
$line=1;
foreach($file as $f){
  if($f!==''){
    echo'<div><a href="actions.php?a=del&line='.$line.'" class="mx-2">x</a><a href="actions.php?a=delSame&line='.sameLine($f).'">same</a> '.addTags($f).'</div>';
  }
  else {
    echo'<div>'.addTags($f).'</div>';
  }
  $line++;
}
?>
</body>
</html>