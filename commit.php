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

function sendInfoAboutUpdate($path,$text){

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

  include("../".$_GET['path']."/_init.php");
  $url='https://'. $config['domain'].'/tools/tg.php';
  error_log($url,0);
  $data=array('text' => '$text'); // Данные для отправки


$ch=curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-type: application/x-www-form-urlencoded;charset=utf-8"));
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$calltouch = curl_exec($ch);
curl_close ($ch);

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
  flex-direction: column;
  align-items: center;
  justify-content: center;
}
.box div {
  text-align: center;
  width: 100px;
  height: 100px;
}

.icon {
  margin-bottom: 20px;
}

.checkmark {
    margin-bottom: 20px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    display: block;
    stroke-width: 4;
    stroke: #4bb71b;
    stroke-miterlimit: 10;
    box-shadow: inset 0px 0px 0px #4bb71b;
    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    position:relative;
    top: 5px;
    right: 5px;
   margin: 0 auto;
}
.checkmark__circle {
    stroke-dasharray: 166;
    stroke-dashoffset: 166;
    stroke-width: 3;
    stroke-miterlimit: 10;
    stroke: #4bb71b;
    fill: #fff;
    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
 
}

.checkmark__check {
    transform-origin: 50% 50%;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
}

@keyframes stroke {
    100% {
        stroke-dashoffset: 0;
    }
}

@keyframes scale {
    0%, 100% {
        transform: none;
    }

    50% {
        transform: scale3d(1.1, 1.1, 1);
    }
}

@keyframes fill {
    100% {
        box-shadow: inset 0px 0px 0px 30px #4bb71b;
    }
}
</style>
<div class="box">
  <div class="icon"><svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg></div>
  <div><a href="../<?=$_GET['path'];?>">НАЗАД</a></div>
</div>