window.onload = function() {

  var myTags = document.getElementsByTagName("script");
  var src = myTags[myTags.length - 1].src;
  var path = unescape(src).split("path=")[1].split("&")[0];

  $("body").append(
    '<div style="position:fixed;bottom:10px;right:10px;background-color:#eee;padding:10px;"><ul><li><a href="../_devtools/commit.php?a=add&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> ADD</a></li><li><a href="../_devtools/commit.php?a=commit&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> ADD + COMMIT</a></li><li><a href="../_devtools/commit.php?a=pushprod&path=' + path + '" style="font-weight:bold;color:#ff3030;"><i class="fab fa-git-alt"></i> ADD + COMMIT + PUSH TO prod</a></li><li><a href="../_devtools/commit.php?a=pushdev&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> ADD + COMMIT + PUSH TO dev</a></li><li><a href="../_devtools/commit.php?a=pushorigin&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> PUSH origin master</a></li></ul></div>');
};