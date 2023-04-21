<?
function getProductVersion($opt){
  $c=file_get_contents('../'.$_GET['path'].'/version.txt', true);
  $version=substr($c,1,strripos($c,'.')-1);
  $subversion=substr($c,strripos($c,'.')+1);
  $add=substr($c,strripos($c,'-')+1);

  $pos=strripos($c,'-');
  if($pos === false) {//no add
    $subversion=substr($c,strripos($c,'.')+1);
    $add='b0';
  } else {//yes add
    $subversion=substr($subversion,0,-(strlen($add)+1));
    $add=substr($c,strripos($c,'-')+1);
  }

  if($opt=='now') return $c;
  if($opt=='next') return 'v'.$version.'.'.++$subversion;
  if($opt=='nextbeta') return 'v'.$version.'.'.$subversion.'-'.++$add;
  if($opt=='version') return $version;
  if($opt=='subversion') return $subversion;
  if($opt=='add') return $add;
}

if($_GET['a']=='add'){
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
}

if($_GET['a']=='commit'){
  file_put_contents('../'.$_GET['path'].'/version.txt', getProductVersion('next'));
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
  shell_exec("git commit -m ".getProductVersion('now'));
}

if($_GET['a']=='commitnextbeta'){
  file_put_contents('../'.$_GET['path'].'/version.txt', getProductVersion('nextbeta'));
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
  shell_exec("git commit -m ".getProductVersion('now'));
}

if($_GET['a']=='pushprod'){
  file_put_contents('../'.$_GET['path'].'/version.txt', getProductVersion('next'));
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
  shell_exec("git commit -m ".getProductVersion('now'));
  shell_exec("git ftp -s prod push -P");
}

if($_GET['a']=='pushprodnextbeta'){
  file_put_contents('../'.$_GET['path'].'/version.txt', getProductVersion('nextbeta'));
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
  shell_exec("git commit -m ".getProductVersion('now'));
  shell_exec("git ftp -s prod push -P");
}

if($_GET['a']=='pushdev'){
  file_put_contents('../'.$_GET['path'].'/version.txt', getProductVersion('next'));
  chdir('../'.$_GET['path']);
  shell_exec("git add -A");
  shell_exec("git commit -m ".getProductVersion('now'));
  shell_exec("git ftp -s dev push -P");
}

if($_GET['a']=='pushdev'){
  chdir('../'.$_GET['path']);
  shell_exec("git push -u origin master");
}

if($_GET['a']=='config'){
  echo 'now: '.getProductVersion('now').'<br>';
  echo 'version: '.getProductVersion('version').'<br>';
  echo 'subversion: '.getProductVersion('subversion').'<br>';
  echo 'add: '.getProductVersion('add').'<br>';
  echo 'next: '.getProductVersion('next').'<br>';
  echo 'nextbeta: '.getProductVersion('nextbeta');
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