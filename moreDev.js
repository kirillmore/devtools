window.onload = function() {
  var myTags = document.getElementsByTagName("script");
  var src = myTags[myTags.length - 1].src;
  var path = unescape(src).split("path=")[1].split("&")[0];
  $("body").append(
    '<div id="moreDev" style="position:fixed;bottom:10px;right:10px;background-color:#eee;font-size:14px;font-family:Arial;padding:10px;z-index:9999;"><div id="moreDev__btn" style="position:absolute;right:0;top:0;padding:10px;cursor:pointer;width:20px;height:20px;">-</div><ul id="moreDev__list" class="list-unstyled" style="margin-bottom:0;"><li><a href="../_devtools/commit.php?a=add&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> ADD</a></li><li><a href="../_devtools/commit.php?a=commit&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> ADD + COMMIT</a>&nbsp;<a href="../_devtools/commit.php?a=commitnextbeta&path=' + path + '" style="font-weight:bold;color:#303030;">(BETA)</a></li><li><a href="../_devtools/commit.php?a=pushprod&path=' + path + '" style="font-weight:bold;color:#ff3030;"><i class="fab fa-git-alt"></i> ADD + COMMIT + PUSH TO prod</a>&nbsp;<a href="../_devtools/commit.php?a=pushprodnextbeta&path=' + path + '" style="font-weight:bold;color:#ff3030;">(BETA)</a></li><li><a href="../_devtools/commit.php?a=pushdev&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> ADD + COMMIT + PUSH TO dev</a></li><li><a href="../_devtools/commit.php?a=pushorigin&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> PUSH origin master</a></li></ul></div>');
  $("#moreDev__btn").on('click', function(event) {
    $("#moreDev__list").toggle();
  });
};