window.onload = function() {
  var src = document.getElementById('moredev').src;
  var path = unescape(src).split("path=")[1].split("&")[0];
  var display = '';

  function set_cookie(name, value) {
    document.cookie = name + '=' + value + '; Path=/;';
  }

  function delete_cookie(name) {
    document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }

  function getCookie(name) {
    function escape(s) { return s.replace(/([.*+?\^$(){}|\[\]\/\\])/g, '\\$1'); }
    var match = document.cookie.match(RegExp('(?:^|;\\s*)' + escape(name) + '=([^;]*)'));
    return match ? match[1] : null;
  }
  if (getCookie('collapse') == 'on') {
    display = 'display:none;';
  }
  $("body").append(
    '<div id="moreDev" style="position:fixed;bottom:10px;right:10px;background-color:#eee;color:black;font-size:14px;font-family:Arial;padding:10px;z-index:9999;"><div id="moreDev__btn" style="position:absolute;right:0;top:0;padding:0 10px;cursor:pointer;width:20px;height:20px;">-</div><ul id="moreDev__list" class="list-unstyled" style="margin-bottom:0;' + display + '"><li><a href="http://localhost/_devtools/errors/index.php" style="font-weight:bold;color:#303030;" target="_blank"><i class="fa-solid fa-bug"></i> <span id="enum"></span> errors</a></li><li><a href="//localhost/_devtools/commit.php?a=add&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> ADD</a></li><li><a href="//localhost/_devtools/commit.php?a=commit&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> ADD + COMMIT</a>&nbsp;<a href="//localhost/_devtools/commit.php?a=commitnextbeta&path=' + path + '" style="font-weight:bold;color:#303030;">(BETA)</a></li><li><a href="//localhost/_devtools/commit.php?a=pushprod&path=' + path + '" style="font-weight:bold;color:#ff3030;"><i class="fab fa-git-alt"></i> ADD + COMMIT + PUSH TO prod</a>&nbsp;<a href="//localhost/_devtools/commit.php?a=pushprodnextbeta&path=' + path + '" style="font-weight:bold;color:#ff3030;">(BETA)</a></li><li><a href="//localhost/_devtools/commit.php?a=pushdev&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> ADD + COMMIT + PUSH TO dev</a></li><li><a href="//localhost/_devtools/commit.php?a=pushorigin&path=' + path + '" style="font-weight:bold;color:#303030;"><i class="fab fa-git-alt"></i> PUSH origin master</a></li></ul></div>');
  $("#moreDev__btn").on('click', function(event) {
    $("#moreDev__list").toggle();
    if (getCookie('collapse') == 'on') {
      delete_cookie('collapse');
    } else {
      set_cookie('collapse', 'on')
    }
  });

  $.get("http://localhost/_devtools/errors/fetch.php").done(function(data) {
    $("#enum").append(data)
  });

};