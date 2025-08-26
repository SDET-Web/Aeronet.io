var publicJS = (function () {
  /********************************************************************************
     GENERAL FUNCTIONS
     ********************************************************************************/
  var generteExcerpt = function ($txt, $length) {
    $txt = $txt.replace(/<.*?>/g, "");
    return $txt.substring(0, $length);
  };

  /**
   * render photo
   */
  var renderPost = function ($objPost, $container) {
      
// Get saved data from sessionStorage
    $userimg = sessionStorage.getItem('key');
   
    $type = publicJS.getPostTypeIcon($objPost.type);
    $content = $objPost.content;
    if ($objPost.type == "p") {
      $photos = $objPost.photo.data;
      for ($i = 0; $i < $photos.length; $i++) {
        $content +=
          '<img src="' +
          publicJS.getPhotoUrl($photos[$i].path) +
          '" style="height:40px;width:40px;" class="tl-img img-left img-circle  mgtp-5" />';
      }
    }

    $comment = "";
    for ($i = 0; $i < $objPost.comment.data.length; $i++) {
      $comment +=
        "                      <li>" +
        '                          <div class="menu-icon"><img style="height:40px;width:40px;" class="tl-img img-left img-circle  mgtp-5" src="' +
        publicJS.getMemberPhoto($objPost.comment.data[$i].photo) +
        '" alt="' +
        $objPost.comment.data[$i].name +
        '"></div>' +
        '                          <div class="menu-text"> ' +
        $objPost.comment.data[$i].text +
        '                              <div class="menu-info"> <span class="menu-date">' +
        publicJS.getDateTime($objPost.comment.data[$i].created) +
        "</span> </div>" +
        "                          </div>" +
        "                      </li>";
    }

    // <a role="button" class="btn btn-sm " href="javascript:void(0)"><i class="fa fa-share fa-fw"></i> Share</a></div>
    $container.append(
      '<li style="margin-top:-45px;" class="tl-item ' +
        $objPost.id +
        '">' +
        '<div class="tl-icon ' +
        $type.color +
        '"> <i class="fa ' +
        $type.icon +
        '"></i> </div>' +
        '<div class="tl-label panel widget light-widget panel-bd-left ' +
        $type.border +
        '" >' +
        '<div class="panel-body">' +
        '<h4 class="mgtp-10 mgbt-xs-5">' +
        '<img style="height:40px;width:40px;" class="tl-img img-left img-circle  mgtp-5" src="' +
        publicJS.getMemberPhotoFromType($objPost.image, $objPost.user_type) +
        '"> <a href="' +
        $baseURL +
        "pilot/" +
        $objPost.user_id +
        '">' +
        $objPost.name +
        '</a> <em class="vd_soft-grey font-sm"></em> </h3>' +
        '          <span class="vd_soft-grey">' +
        publicJS.getDateTime($objPost.created) +
        "</span>" +
        '          <div class="clearfix mgbt-xs-10"></div>' +
        '          <div class="mgbt-xs-20"> ' +
        $content +
        "</div>" +
        '<div class="tl-action" style="background-color:#fff;padding-left:6px;><a role="button" onclick="publicJS.likeIt($(this))" id="like-' +
        $objPost.id +
        '" object-id="' +
        $objPost.id +
        '" like-count="' +
        $objPost.like +
        '"  class="btn btn-sm mgr-10" href="javascript:void(0)"><i class="fa fa-thumbs-up fa-fw"></i> Like (<span class="like-count">' +
        $objPost.like +
        '</span>)</a> <a role="button" class="btn btn-sm btn-xs mgr-10" href="javascript:void(0)"><i class="fa fa-comment fa-fw"></i> Comment (<span id="comment-count-' +
        $objPost.id +
        '">' +
        $objPost.comment.total +
        "</span>)</a> " +
        '          <hr class="mgtp-0"/>' +
        '          <div class="comments">' +
        '           <div class="content-list content-image">' +
        '                  <ul class="list-wrapper no-bd-btm" id="comment-' +
        $objPost.id +
        '">' +
        $comment +
        "                  </ul>" +
        "              </div>" +
        '              <hr class="no-bd"/>' +
        '              <div class="reply-comment" style="margin-left:10px;">' +
        '                  <div class="content-list content-image">' +
        '                      <div class="list-wrapper">' +
        "                          <div>" +
        '                              <div class="menu-icon"><img src="' +
        publicJS.getMemberPhotoFromType($userimg , $objPost.user_type) +
        '" alt="pilot" style="height:40px;width:40px;" class="tl-img img-left img-circle  mgtp-5"></div>' +
        '                              <div class="menu-text">' +
        '                                  <textarea id="textarea-' +
        $objPost.id +
        '" rows="3" class="width-100" placeholder="Write a comment..."></textarea>' +
        '                                  <button object-id="' +
        $objPost.id +
        '" onclick="publicJS.postComment($(this))" class="btn vd_btn btn-xs vd_bg-blue"> <i class="fa fa-comment append-icon"></i> Post Comment </button>' +
        "                              </br></br></div>" +
        "                          </div>" +
        "                      </div>" +
        "                  </div>" +
        "              </div>" +
        "          </div>" +
        "      </div>" +
        "  </div>" +
        "</li>"
    );
  };

  /**
   * render post
   */

  var renderArticle = function ($objPost, $container) {
    $content = $objPost.excerpt;

    $container.append(
      '<div class="col-sm-12 mb-30 article-box">' +
        '  <div class="col-xs-12">' +
        '      <div class="post-prev-title font-alt">' +
        '          <a href="' +
        $baseURL +
        "skywriter/" +
        $objPost.id +
        '">' +
        $objPost.title +
        "</a>" +
        "      </div>" +
        '      <div class="blog-item-data">' +
        '         <a href="' +
        $baseURL +
        "skywriter/" +
        $objPost.id +
        '"><img src="' +
        publicJS.getMemberPhoto($objPost.image) +
        '" height="30px" alt=""></a>' +
        //+ '         <a href="' + $baseURL + 'pilot/' + $objPost.user_id + '">' + $objPost.name + '</a>'
        '         <span class="separator">&nbsp;</span>' +
        '         <a href="' +
        $baseURL +
        "skywriter/" +
        $objPost.id +
        '"><i class="fa fa-clock-o"></i> ' +
        publicJS.getDateTime($objPost.created) +
        "</a>" +
        '         <span class="separator">&nbsp;</span>' +
        '         <a href="' +
        $baseURL +
        "skywriter/" +
        $objPost.id +
        '"><i class="fa fa-comments"></i> ' +
        $objPost.comment.total +
        " Comments</a>" +
        "      </div>" +
        ($objPost.coverPhoto
          ? '      <div class="post-prev-img">' +
            '        <a href="' +
            $baseURL +
            "skywriter/" +
            $objPost.id +
            '">' +
            $objPost.coverPhoto +
            "</a>" +
            "      </div>"
          : "") +
        '      <div class="blog-item-body">' +
        "        <p>" +
        $content +
        '&nbsp;<a href="' +
        $baseURL +
        "skywriter/" +
        $objPost.id +
        '">read more</a</p>' +
        "      </div>" +
        "  </div>" +
        "</div>"
    );
  };

  /*
   * render message
   */

  var renderMessage = function ($objMessage, $container) {
    $container.append(
      '<li style="margin-top:20px;">' +
        '  <div class="menu-icon"><img src="' +
        publicJS.getMemberPhoto($objMessage.image) +
        '" alt="pilot"></div>' +
        '  <div class="menu-text">' +
        $objMessage.name +
        '      <div class="menu-info">' +
        '          <span class="menu-date">' +
        publicJS.getDateTime($objMessage.time) +
        "</span>" +
        "      </div>" +
        "  </div>" +
        "  <div>" +
        $objMessage.message +
        "  </div>" +
        "</li>"
    );
  };

  var renderConversation = function ($objMessage, $container) {
    console.log($objMessage);
    $container.append(
      '<li style="margin-top:20px;cursor:pointer;" onclick="window.location.href=\'' +
        $baseURL +
        "/conversation/" +
        $objMessage.convo +
        "'\">" +
        '  <div class="menu-icon"><img src="https://aeronet.io/upload/photo/' +
        $objMessage.image +
        '" alt="pilot"></div>' +
        '  <div class="menu-text">' +
        $objMessage.fname +
        " " +
        $objMessage.lname +
        '      <div class="menu-info">' +
        '          <span class="menu-date">' +
        publicJS.getDateTime($objMessage.created) +
        "</span>" +
        "      </div>" +
        "  </div>" +
        "  <div>" +
        $objMessage.text +
        "  </div>" +
        "</li>"
    );
  };

  /**
   * generic loading function for public info
   */
  var loadData = function ($container, $refill, $renderFunction, $dataType) {
    $dataType = $dataType ? $dataType : false;
    $photoIDs = [];
    if ($container.attr("isBlocked") == "false") {
      $container.attr("isBlocked", true);
      $input = {
        page: $container.attr("page"),
        sort: $container.attr("sort"),
        search: $container.attr("searchTerm"),
      };

      if ($refill == true) {
        $container.html("");
      }
      $container.append('<div class="loader">Loading ...</div>');

      // we need to see all this dynamic stuff going on

      $.post($container.attr("url"), $input, function (json) {
        json = json.data;
        $($container.attr("countContainer")).html(json.total);
        $container.children(".loader").remove();
        $data = json.data;
        if ($data.length > 0) {
          for (i = 0; i < $data.length; i++) {
            $renderFunction($data[i], $container);
            if ($dataType != false) {
              $photoIDs[$photoIDs.length] = $data[i].objectId;
            }
          }
        } else {
          if (json.total <= 0) {
            $container.html(
              '<p class="info">' + $container.attr("zeroMessage") + "</p>"
            );
          }
          $container.attr("isBlocked", true);
        }

        $container.attr("totalCount", json.total);
        $container.attr("page", parseInt($container.attr("page")) + 1);
        if ($data.length == 25) {
          $container.attr("isBlocked", false);
        } else {
          $container.attr("isBlocked", true);
        }
      });
    }
  };

  /** for javascript data type return string */
  var stringify = function (obj) {
    var t = typeof obj;
    if (t != "object" || obj === null) {
      if (t == "string") obj = '"' + obj + '"';
      return String(obj);
    } else {
      /** recurse array or object */
      var n,
        v,
        json = [],
        arr = obj && obj.constructor == Array;
      for (n in obj) {
        v = obj[n];
        t = typeof v;
        if (t == "string") v = '"' + v + '"';
        else if (t == "object" && v !== null) v = JSON.stringify(v);
        json.push((arr ? "" : '"' + n + '":') + String(v));
      }
      return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
    }
  };

  return {
    init: function () {
      $(".post-list").each(function () {
        loadData($(this), true, renderPost);
      });

      $(".message-list").each(function () {
        loadData($(this), true, renderMessage);
      });

      $(".conversation-list").each(function () {
        loadData($(this), true, renderConversation);
      });

      $(".skywriter-list").each(function () {
        loadData($(this), true, renderArticle);
      });
    },
    scroll: function (scrollPos) {
      $(".post-list").each(function () {
        if ($(this).is(":visible")) {
          $(this).append();
          loadData($(this), false, renderPost);
        }
      });

      $(".skywriter-list").each(function () {
        if ($(this).is(":visible")) {
          $(this).append();
          loadData($(this), true, renderArticle);
        }
      });
    },

    getMemberPhoto: function ($url) {
      $photo =
        "data:image/png;base64,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";
      if ($url != "") {
        $photo =
          ($url.indexOf("http") < 0 ? $baseURL + "upload/photo/" : "") + $url;
      }

      return $photo;
    },

    getMemberPhotoFromType: function ($url, $type) {
      $userTypes = {
        A: { name: "Air Traffic Controller", icon: "A.png" },
        D: { name: "Department", icon: "dep.png" },
        S: { name: "Flight Dispatcher", icon: "D.png" },
        E: { name: "", icon: "" },
        F: { name: "Flight Attendent", icon: "F.png" },
        G: { name: "", icon: "" },
        I: { name: "", icon: "" },
        L: { name: "", icon: "" },
        M: { name: "Mechanic", icon: "M.png" },
        N: { name: "", icon: "" },
        P: { name: "Pilot", icon: "P.png" },
        R: { name: "", icon: "" },
        T: { name: "", icon: "" },
        U: { name: "", icon: "" },
        W: { name: "", icon: "" },
        X: { name: "", icon: "" },
      };

      if ($url != "") {
        return (
          ($url.indexOf("http") < 0 ? $baseURL + "upload/photo/" : "") + $url
        );
      } else {
        $userType = $userTypes[$type.toUpperCase()];
        console.log($userTypes, $userType, $type);
        if ($userType["icon"]) {
          return $baseURL + "assets/images/types/" + $userType["icon"];
        } else {
          return $baseURL + "assets/images/types/P.png";
        }
      }
    },

    getPhotoUrl: function ($url) {
      $photo =
        "data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzIDUzIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1MyA1MzsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiNFN0VDRUQ7IiBkPSJNMTguNjEzLDQxLjU1MmwtNy45MDcsNC4zMTNjLTAuNDY0LDAuMjUzLTAuODgxLDAuNTY0LTEuMjY5LDAuOTAzQzE0LjA0Nyw1MC42NTUsMTkuOTk4LDUzLDI2LjUsNTMgIGM2LjQ1NCwwLDEyLjM2Ny0yLjMxLDE2Ljk2NC02LjE0NGMtMC40MjQtMC4zNTgtMC44ODQtMC42OC0xLjM5NC0wLjkzNGwtOC40NjctNC4yMzNjLTEuMDk0LTAuNTQ3LTEuNzg1LTEuNjY1LTEuNzg1LTIuODg4di0zLjMyMiAgYzAuMjM4LTAuMjcxLDAuNTEtMC42MTksMC44MDEtMS4wM2MxLjE1NC0xLjYzLDIuMDI3LTMuNDIzLDIuNjMyLTUuMzA0YzEuMDg2LTAuMzM1LDEuODg2LTEuMzM4LDEuODg2LTIuNTN2LTMuNTQ2ICBjMC0wLjc4LTAuMzQ3LTEuNDc3LTAuODg2LTEuOTY1di01LjEyNmMwLDAsMS4wNTMtNy45NzctOS43NS03Ljk3N3MtOS43NSw3Ljk3Ny05Ljc1LDcuOTc3djUuMTI2ICBjLTAuNTQsMC40ODgtMC44ODYsMS4xODUtMC44ODYsMS45NjV2My41NDZjMCwwLjkzNCwwLjQ5MSwxLjc1NiwxLjIyNiwyLjIzMWMwLjg4NiwzLjg1NywzLjIwNiw2LjYzMywzLjIwNiw2LjYzM3YzLjI0ICBDMjAuMjk2LDM5Ljg5OSwxOS42NSw0MC45ODYsMTguNjEzLDQxLjU1MnoiLz4KPGc+Cgk8cGF0aCBzdHlsZT0iZmlsbDojNTU2MDgwOyIgZD0iTTI2Ljk1MywwLjAwNEMxMi4zMi0wLjI0NiwwLjI1NCwxMS40MTQsMC4wMDQsMjYuMDQ3Qy0wLjEzOCwzNC4zNDQsMy41Niw0MS44MDEsOS40NDgsNDYuNzYgICBjMC4zODUtMC4zMzYsMC43OTgtMC42NDQsMS4yNTctMC44OTRsNy45MDctNC4zMTNjMS4wMzctMC41NjYsMS42ODMtMS42NTMsMS42ODMtMi44MzV2LTMuMjRjMCwwLTIuMzIxLTIuNzc2LTMuMjA2LTYuNjMzICAgYy0wLjczNC0wLjQ3NS0xLjIyNi0xLjI5Ni0xLjIyNi0yLjIzMXYtMy41NDZjMC0wLjc4LDAuMzQ3LTEuNDc3LDAuODg2LTEuOTY1di01LjEyNmMwLDAtMS4wNTMtNy45NzcsOS43NS03Ljk3NyAgIHM5Ljc1LDcuOTc3LDkuNzUsNy45Nzd2NS4xMjZjMC41NCwwLjQ4OCwwLjg4NiwxLjE4NSwwLjg4NiwxLjk2NXYzLjU0NmMwLDEuMTkyLTAuOCwyLjE5NS0xLjg4NiwyLjUzICAgYy0wLjYwNSwxLjg4MS0xLjQ3OCwzLjY3NC0yLjYzMiw1LjMwNGMtMC4yOTEsMC40MTEtMC41NjMsMC43NTktMC44MDEsMS4wM1YzOC44YzAsMS4yMjMsMC42OTEsMi4zNDIsMS43ODUsMi44ODhsOC40NjcsNC4yMzMgICBjMC41MDgsMC4yNTQsMC45NjcsMC41NzUsMS4zOSwwLjkzMmM1LjcxLTQuNzYyLDkuMzk5LTExLjg4Miw5LjUzNi0xOS45QzUzLjI0NiwxMi4zMiw0MS41ODcsMC4yNTQsMjYuOTUzLDAuMDA0eiIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=";
      if ($url != "") {
        $photo = $baseURL + "upload/photo/" + $url;
      }

      return $photo;
    },

    getDateTime: function ($timestamp) {
      var date = new Date($timestamp * 1000);
      var dated = date.getDate();
      var month = date.getMonth() + 1;
      var year = date.getFullYear();
      var hours = date.getHours();
      var minutes = "0" + date.getMinutes();
      var seconds = "0" + date.getSeconds();
      return (
        month +
        "/" +
        dated +
        "/" +
        year +
        " " +
        hours +
        ":" +
        minutes.substr(-2)
      );
      var formattedTime =
        hours + ":" + minutes.substr(-2) + ":" + seconds.substr(-2);
    },

    getPostTypeIcon: function ($type) {
      if ($type == "p") {
        return {
          icon: "fa-image",
          color: "warning",
          border: "vd_bdl-yellow",
        };
      } else if ($type == "n") {
        return {
          icon: "fa-edit",
          color: "primary",
          border: "vd_bd-black",
        };
      } else if ($type == "a") {
        return {
          icon: "fa-edit",
          color: "primary",
          border: "vd_bd-black",
        };
      } else if ($type == "s") {
        return {
          icon: "fa-comments",
          color: "success",
          border: "vd_bdl-green",
        };
      } else if ($type == "f") {
        return {
          icon: "fas fa-plane",
          color: "default",
          border: "vd_bdl-default",
        };
      }
    },

    likeIt: function ($this) {
      $.get(
        $baseURL + "post/like/" + $this.attr("object-id"),
        function (resonse) {
          $this.attr("like-count", resonse);
          $this.find(".like-count").html(resonse);
        }
      );
    },

    postComment: function ($this) {
      $.post(
        $baseURL + "post/comment",
        {
          text: $("#textarea-" + $this.attr("object-id")).val(),
          user_id: $user.id,
          post_id: $this.attr("object-id"),
        },
        function (response) {
          $("#comment-count-" + $this.attr("object-id")).html(
            parseInt(
              $("#comment-count-" + $this.attr("object-id")).html(),
              10
            ) + 1
          );
          $("#comment-" + $this.attr("object-id")).append(
            "<li>" +
              '  <div class="menu-icon"><img src="' +
              publicJS.getMemberPhoto(response.data.photo) +
              '" alt="' +
              response.data.name +
              '"></div>' +
              '  <div class="menu-text"> ' +
              response.data.text +
              '      <div class="menu-info"> <span class="menu-date">' +
              publicJS.getDateTime(response.data.created) +
              "</span> </div>" +
              "  </div>" +
              "</li>"
          );
          $("#textarea-" + $this.attr("object-id")).val("");
        }
      );
    },

    markNotification: function ($this, $id) {
      $.get($baseURL + "post/notimark/" + $id, function (response) {
        console.log(response);
        $("#myModal .modal-body ul").html("");
        renderPost(response.data, $("#myModal .modal-body ul"));
        $("#myModal").modal();
        $var = $(".noti-count").first().html();
        $(".noti-count").html($var - 1);
      });
      $this.remove();
    },

    postDetail: function ($id) {
      $.get($baseURL + "post/detail/" + $id, function (response) {
        console.log(response);
        $("#myModal .modal-body").html("");
        renderPost(response.data, $("#myModal .modal-body ul"));
        $("#myModal").modal();
      });
    },

    addChat: function ($id) {
      $convo = $id + "-" + $user.id;
      if ($user.id > $id) {
        $convo = $user.id + "-" + $id;
      }
      $.get(
        $baseURL + "conversation/mark/" + $convo.replace("-", "::"),
        function (response) {
          console.log(response);
        }
      );
      $("#convo-" + $convo).removeClass("hidden");
      return false;
    },

    closeChat: function ($id) {
      $convo = $id + "-" + $user.id;
      if ($user.id > $id) {
        $convo = $user.id + "-" + $id;
      }
      $("#convo-" + $convo).addClass("hidden");
      return false;
    },

    sendMessage: function (event, $this, $id) {
      if (event.which == 13) {
        publicJS.sendText($this, $id);
      }
      return false;
    },

    sendText: function ($this, $id) {
      $convo = $id + "-" + $user.id;
      if ($user.id > $id) {
        $convo = $user.id + "-" + $id;
      }
      $text = $("#demo-message").html();
      $text = $text.replace("MESSAGE", $this.val());
      var today = new Date();
      var dd = today.getDate();
      var mm = today.getMonth() + 1; //January is 0!

      var yyyy = today.getFullYear();
      if (dd < 10) {
        dd = "0" + dd;
      }
      if (mm < 10) {
        mm = "0" + mm;
      }
      var today = dd + "/" + mm + "/" + yyyy;
      $text = $text.replace("TIME", today);
      $("#convo-" + $convo)
        .find(".messages-list")
        .append($text);
      $input = { message: $this.val() };
      $.post(
        $baseURL + "conversation/add/" + $user.id + "/" + $id,
        $input,
        function (json) {}
      );
      window.location.reload(true);
      $this.val("");
    },
  };
})();

console.log(publicJS.getMemberPhotoFromType("", "D"));
