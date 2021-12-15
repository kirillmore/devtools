<?
function getProductVersion($opt){
  $c=file_get_contents('../'.$_GET['path'].'/version.txt', true);
  $version=substr($c,1,strripos($c,'.')-1);
  $subversion=substr($c,strripos($c,'.')+1);
  if(!isset($opt)) return $c;
  if($opt=='next') return 'v'.$version.'.'.++$subversion;
  if($opt=='version') return $version;
  if($opt=='subversion') return $subversion;
}

if($_GET['a']=='add'){
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
}

if($_GET['a']=='commit'){
  file_put_contents('../'.$_GET['path'].'/version.txt', getProductVersion('next'));
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
  shell_exec("git commit -m ".getProductVersion());
}

if($_GET['a']=='pushprod'){
  file_put_contents('../'.$_GET['path'].'/version.txt', getProductVersion('next'));
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
  shell_exec("git commit -m ".getProductVersion());
  shell_exec("git ftp -s prod push -P");
}

if($_GET['a']=='pushdev'){
  file_put_contents('../'.$_GET['path'].'/version.txt', getProductVersion('next'));
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
  shell_exec("git commit -m ".getProductVersion());
  shell_exec("git ftp -s dev push -P");
}

if($_GET['a']=='pushdev'){
  chdir('../'.$_GET['path']);
  shell_exec("git push -u origin master");
}

?>

<style>
.box {
  min-height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.box div {
  width: 100px;
  height: 100px;
}
</style>
<div class="box">
  <div><a href="../<?=$_GET['path'];?>">НАЗАД</a></div>
</div>