$(document).ready(function () {
  PNotify.prototype.options.styling = "bootstrap3";

  $("input[name='nnumber']").keyup(function () {
    $(this).val($(this).val().toUpperCase());
  });

  $("#ifr, #vfr").click(function () {
    $(".ifr, .vfr").hide();
    $("#ifr, #vfr").removeClass("btn-primary");
    $("#ifr, #vfr").addClass("btn-white");
    $(this).addClass("btn-primary");
    $("." + $(this).prop("id").replace("#", ".")).show();
    $("#type").val($(this).prop("id").replace("#", "."));
  });

  if (window.location.hash != "") {
    $('a[href="' + window.location.hash + '"]').click();
  }

  //,.nav.nav-pills.nav-justified a
  $(".vd_btn.next,.vd_btn.prev").click(function () {
    if ($("#tab32").hasClass("active")) {
      $(".form-horizontal").attr("action", document.URL + "#tab33");
      $(".form-horizontal").submit();
    }
  });

  $manufacturer = "";
  publicJS.init();

$("#post-it").click(function () {
    if ($("#post-content").val() != "") {
      var images = [];
      $(".image-panel img").each(function () {
        images.push($(this).attr("src"));
      });

      const input = {
        type: "s",
        user_id: $user.id,
        content: $("#post-content").val(),
        images: images,
        tagged: $("#tagged").val(),
      };
      console.log(input);

      $.post($baseURL + "post/add", input, function (response) {
        window.location.reload(true);
        if (response.status == "success") {
          window.location.reload(true);
        }
      }).fail(function (xhr, status, error) {
        window.location.reload(true);
      });
    }
  });




  $("#add-news-article").click(function () {
    $(".new-add-edit").toggleClass("hidden");
  });

  $(".manufacturer").each(function () {
    $(this).html($(".manufacturer-select").html());
    $(this).val($(this).attr("selected-object"));
    $model = $($(this).attr("connected-model"));
    $.get($baseURL + "ajax/model_directory/" + $(this).val(), function ($data) {
      $model.html($data);
      $model.val($(this).attr("selected-object"));
    });
  });

//$(".emojis-plain").emojiarea({ wysiwyg: false });

  $(".html-editor").keyup(function (event) {
    if (event.keyCode == 13) {
      $(this).append("<br />");
      $("#" + $(this).attr("text-id")).val("<br />");
    } else if (event.keyCode == 8) {
    } else if (event.keyCode == 32) {
      $(this).append("&nbsp;");
      $("#" + $(this).attr("text-id")).val("&nbsp;");
    } else {
      $(this).append(event.key);
      $("#" + $(this).attr("text-id")).val(event.key);
    }
    return false;
  });

  
  $("#post-article").click(function () {
    if (tinymce.activeEditor.getContent() != "") {
      $.post(
        $baseURL + "post/add",
        {
          type: "n",
          user_id: $user.id,
          content: tinymce.activeEditor.getContent(),
        },
        function (response) {
          if (response.status == "success") {
            window.location.reload(true);
          }
        }
      );
    }
  });

  $("#save-article").click(function () {
    if (tinymce.activeEditor.getContent() != "") {
      $.post(
        $baseURL + "post/add",
        {
          type: "n",
          user_id: $user.id,
          content: tinymce.activeEditor.getContent(),
          id: $("#new-id").val(),
        },
        function (response) {
          if (response.status == "success") {
            window.location.reload(true);
          }
        }
      );
    }
  });

  $("#filetoattach").change(function (event) {
    var files = event.target.files;
    for (var i = 0, f; (f = files[i]); i++) {
      if (!f.type.match("image.*")) {
        continue;
      }
      var reader = new FileReader();
      reader.onload = (function (theFile) {
        return function (e) {
          $(".image-panel").append('<img src="' + e.target.result + '"/>');
          $(".image-panel").removeClass("hidden");
          $(".user-panel").addClass("hidden");
          $(".emoji-picker-icon").addClass("emoji-down");
        };
      })(f);
      reader.readAsDataURL(f);
    }
  });

  $("#filetoattach_flight").change(function (event) {
    var files = event.target.files;
    for (var i = 0, f; (f = files[i]); i++) {
      if (!f.type.match("image.*")) {
        continue;
      }
      var reader = new FileReader();
      reader.onload = (function (theFile) {
        return function (e) {
          $(".image-panel-flight").append(
            '<img src="' +
              e.target.result +
              '"/><input type="hidden" name="images[]" value="' +
              e.target.result +
              '"/>'
          );
          $(".image-panel-flight").removeClass("hidden");
        };
      })(f);
      reader.readAsDataURL(f);
    }
  });

  $("#changeCover").change(function (event) {
    var files = event.target.files;
    $("#coverForm").submit();
  });

  $("#profile-photo-file").change(function (event) {
    var files = event.target.files;
    $("#profileForm").submit();
  });

  $("#videotoattach_flight").change(function (event) {
    var files = event.target.files;
    for (var i = 0, f; (f = files[i]); i++) {
      if (!f.type.match("video.*")) {
        continue;
      }
      var reader = new FileReader();
      reader.onload = (function (theFile) {
        return function (e) {
          $(".video-panel-type").val(theFile.type);
          $(".video-panel-flight").val(e.target.result);
        };
      })(f);
      reader.readAsDataURL(f);
    }
  });

  $(".post-tag").click(function () {
    $(".emoji-picker-icon").addClass("emoji-down");
    $(".user-panel").removeClass("hidden");
    $(".image-panel").addClass("hidden");
  });

  $("#uploadPhotos").dropzone({
    url: $baseURL + "doupload/photo/" + $user.id,
    success: function (data, response) {
      console.log(data);
      console.log(response);
    },
    queuecomplete: function () {
      console.log($baseURL + "post/photo/" + $user.id);
      $.get($baseURL + "post/photo/" + $user.id, function (resonse) {
        window.location.reload(true);
      });
    },
  });

  $uploadedFiles = [];

  $("#uploadFlightPhotos").dropzone({
    url: $baseURL + "doupload/photo/" + $user.id,
    success: function (data, response) {
      $uploadedFiles.push(response);
    },
  });

  $uploadedFilesVFR = [];

  $("#uploadFlightPhotosVFR").dropzone({
    url: $baseURL + "doupload/photo/" + $user.id,
    success: function (data, response) {
      $uploadedFilesVFR.push(response);
    },
  });

  $(".photosUpload").dropzone({
    url: $baseURL + "doupload/photo/" + $user.id,
    success: function (data, response) {
      console.log(data);
      console.log(response);

      $(".trumbowyg-editor").append(
        '<img src="/upload/photo/' + response + '" />'
      );
    },
    queuecomplete: function () {},
  });

  $(".deletePhoto").click(function () {
    $this = $(this);
    $.post(
      $baseURL + "ajax/delete_photo",
      {
        action: "delete_photo",
        photo: $(this).attr("photoId"),
      },
      function () {
        $this.parent().parent().fadeOut();
        window.location.reload(true);
      }
    );
  });

  $("#n_number").keyup(function () {
    //$.get($baseURL + 'ajax/get_aircraft_manufacturer/' + $(this).val(), function (json) {
    $.get(
      $baseURL + "ajax/get_aircraft_nNumbers/" + $(this).val(),
      function (json) {
        $(".n_number_suggestion").html("");
        for ($i = 0; $i < json.data.length; $i++) {
          jQuery(".n_number_suggestion").append(
            "<li onclick=\"select_n_number('#n_number' , '" +
              json.data[$i].title +
              "', '.n_number_suggestion')\">" +
              json.data[$i].title +
              "</li>"
          );
        }
        $(".n_number_suggestion").show();
      }
    );
  });

  $("#n_number_job").keyup(function () {
    //$.get($baseURL + 'ajax/get_aircraft_manufacturer/' + $(this).val(), function (json) {
    $.get(
      $baseURL + "ajax/get_aircraft_nNumbers/" + $(this).val(),
      function (json) {
        $(".n_number_suggestion").html("");
        for ($i = 0; $i < json.data.length; $i++) {
          jQuery(".n_number_suggestion").append(
            "<li onclick=\"select_n_number('#n_number_job' , '" +
              json.data[$i].title +
              "', '.n_number_suggestion')\">" +
              json.data[$i].title +
              "</li>"
          );
        }
        $(".n_number_suggestion").show();
      }
    );
  });

  $("#companyname").keyup(function () {
    $.get(
      $baseURL + "ajax/department_directory/" + $(this).val(),
      function (json) {
        $(".companyname_suggestion").html("");
        for ($i = 0; $i < json.data.length; $i++) {
          jQuery(".companyname_suggestion").append(
            "<li onclick=\"putsuggestion('" +
              json.data[$i].title +
              "')\">" +
              json.data[$i].title +
              "</li>"
          );
        }
      }
    );
  });

  $(".connect").click(function () {
    $_this = $(this);
    $.get(
      $baseURL + "connect/" + $(this).attr("object-id") + "/" + $user.id,
      function (response) {
        new PNotify({
          title: "Connect",
          text: "Request sent!",
          type: "success",
        });
        if (response.message == "success") {
          $_this.parent().parent().fadeOut();
        }
      }
    );
    return false;
  });

  $(".connect_big").click(function () {
    $_this = $(this);
    $.get(
     $baseURL + "connect/" + $(this).attr("object-id") + "/" + $user.id,
      function (response) {
       new PNotify({
          title: "Connect",
          text: "Connect me request sent",
          type: "success",
        });

        if (response.message == "success") {
          $_this.parent().parent().parent().fadeOut();
        } 
      }
    );
    return false;
  });

  $(".invite").click(function () {
    $_this = $(this);
    $.get(
      $baseURL + "invite/" + $user.id + "/" + $(this).attr("object-id"),
      function (response) {
        new PNotify({
          title: "Follow Me",
          text: "Invitation Sent!",
          type: "success",
        });

        if (response.message == "success") {
          $_this.parent().parent().parent().fadeOut();
        }
      }
    );
    return false;
  });

  $(".follow_big").click(function () {
    $_this = $(this);
    $.get(
      $baseURL + "follow/" + $(this).attr("object-id") + "/" + $user.id,
      function (response) {
       new PNotify({
          title: "Follow",
          text: "Following",
          type: "success",
        });

        if (response.message == "success") {
          $_this.parent().parent().fadeOut();
        } 
      }
    );
    return false;
  });

 
  $(".accept-user").click(function () {
    $_this = $(this);
    $.get(
      $baseURL + "accept/" + $(this).attr("object-id") + "/" + $user.id,
      function (response) {
       new PNotify({
          title: "Accept",
          text: "Accepted",
          type: "success",
        });

        if (response.message == "success") {
          $_this.parent().parent().parent().fadeOut();
        } 
      }
    );
  });

  $(".accept-users").click(function () {
    $_this = $(this);
    $.get(
      $baseURL + "accept/" + $(this).attr("object-id") + "/" + $user.id,
      function (response) {
        if (response.message == "success") {
          window.location.reload();
        }
      }
    );
    return false;
  });
  
  

$(".accept-followme").click(function () {
    $_this = $(this);
    $.get(
      $baseURL + "accept/" + $user.id  + "/" + $(this).attr("object-id"),
      function (response) {
        console.log(response);
        if (response.message == "success") {
          $_this.parent().parent().parent().fadeOut();window.location.reload();
        }
      }
    );
  });

  $(".decline-user").click(function () {
    $_this = $(this);
    $.get(
      $baseURL + "decline/" + $(this).attr("object-id") + "/" + $user.id,
      function (response) {
       new PNotify({
          title: "Decline",
          text: "Declined",
          type: "success",
        });

        if (response.message == "success") {
          $_this.parent().parent().parent().fadeOut();
        } 
      }
    );
  });

  if ($("#wizard-3").length > 0) {
    $("#wizard-3").bootstrapWizard({
      tabClass: "nav nav-pills nav-justified",
      nextSelector: ".wizard .next",
      previousSelector: ".wizard .prev",
      onTabShow: function () {
        $("#wizard-3 .finish").hide();
        $("#wizard-3 .next").show();
        if ($("#wizard-3 .nav li:last-child").hasClass("active")) {
          $("#wizard-3 .next").hide();
          $("#wizard-3 .finish").show();
        }
      },
      onNext: function () {
        scrollTo("#wizard-3", -100);
      },
      onPrevious: function () {
        scrollTo("#wizard-3", -100);
      },
    });
  }

  if ($(".courseListingClass").length > 0) {
    $ar = [];
    $(".courseListingClass .row.rowwidth.rightBorder").each(function () {
      $columnAction = $(this).find(".column1");
      $columnID = $(this).find(".column2");
      $columnTitle = $(this).find(".titleColumn");
      $columnCost = $(this).find(".column4");
      $columnAuthor = $(this).find(".authorColumn");
      $columnCredit = $(this).find(".creditColumn");

      $desc = $.trim($columnTitle.find("a").attr("onmouseover"));

      $ar.push({
        a: $.trim($columnID.html()),
        b: $.trim($columnTitle.find("a").html()),
        c: $.trim($columnCost.html()),
        d: $.trim($columnAuthor.html()),
        e: $.trim($columnCredit.find(".phaseCredit").html()),
        f: $desc.substr(16, $desc.length - 5),
        g: $.trim($columnAction.find("a:first-child").attr("href")),
      });
    });
    $.post(
      "/ajax/cron_job_courses",
      { action: "postit", data: $ar },
      function ($response) {
        console.log($response);
      }
    );
  }

  $(".showPostArticle").click(function () {
    $(".article-write").removeClass("hidden");
  });

  $(".hidePostArticle").click(function () {
    window.location.reload(true);
  });

  $("[data-modal-external-file]").click(function (e) {
    e.preventDefault();
    var modalTarget, modalFile;
    if ($(this).closest(".item").attr("data-id")) {
      modalTarget = $(this).closest(".item").attr("data-id");
      modalFile = "modal_item.php";
    } else {
      modalTarget = $(this).attr("data-target");
      modalFile = $(this).attr("data-modal-external-file");
    }
    openModalNew(modalTarget, modalFile);
  });
});

function select_n_number($element, $val, $suggestion_list) {
  $($element).val($val);
  $($suggestion_list).hide();
  // send an ajax call to load make and model here

  $.get($baseURL + "ajax/load_make_model_by_n_number/" + $val, function (json) {
    $("#model").html("");
    $("#manufacturer").html("");
    for ($i = 0; $i < json.data.length; $i++) {
      if ($element == "#n_number_job") {
        $("#aircraftModel").val(json.data[$i].model_name);
        $("#aircraftMake").val(json.data[$i].mfr_name);
      }
      $("#model").html(json.data[$i].model_name);
      $("#manufacturer").html(json.data[$i].mfr_name);
    }
  });
}

function putsuggestion($val) {
  $("#companyname").val($val);
  $(".companyname_suggestion").hide();
}

function select_suggestion($element, $val, $suggestion_list) {
  $($element).val($val);
  $($suggestion_list).hide();
}

function updateModel($val, $id) {
  $("#manufacturer_" + $id).val($val);
  $("#suggestion_" + $id)
    .html("")
    .hide();
  /*$.get($baseURL + 'ajax/model_directory/' + $val,function(json){
            $('.model-' + $id).html(json);
        });*/
}

function model_search($val, $id) {
  $object_id = $id.attr("object-id");
  $.get(
    $baseURL +
      "ajax/model_directory_search/" +
      $("#" + $id.attr("manufacturer-id")).val() +
      "/" +
      $val,
    function (json) {
      $("#suggestion_" + $object_id)
        .html("")
        .show();
      for ($i = 0; $i < json.length; $i++) {
        $("#model_suggestion_" + $object_id).append(
          "<li onclick=\"updateModel('" +
            json[$i].key +
            "',$object_id)\">" +
            json[$i].val +
            "</li>"
        );
      }
    }
  );
}

function aircraft_search($val, $object_id) {
  $.get($baseURL + "ajax/make_model_directory_search/" + $val, function (json) {
    $("#model_suggestion_" + $object_id)
      .html("")
      .show();
    for ($i = 0; $i < json.length; $i++) {
      $("#model_suggestion_" + $object_id).append(
        "<li onclick=\"updateModel('" +
          json[$i].key +
          "',$object_id)\">" +
          json[$i].val +
          "</li>"
      );
    }
  });
}

$addCounter = 2;

function markDelete($id, $type) {
  $("#" + $type + $id).hide();
  $("#" + $type + "status" + $id).val("delete");
}

function addEmployee($id) {
  $ele = $("#emp" + $id);
  $company = $ele.find('input[name="empcompanyName[]"]');
  $title = $ele.find('input[name="empjobTitle[]"]');
  $fromMonth = $ele.find('input[name="empmonthFormJob[]"]');
  $fromYear = $ele.find('input[name="empyearFormJob[]"]');
  $toMonth = $ele.find('input[name="empmonthToJob[]"]');
  $toYear = $ele.find('input[name="empyearToJob[]"]');
  $duties = $ele.find('input[name="empjobDuties[]"]');
  if (
    $company.val() == "" ||
    $title.val() == "" ||
    $fromMonth.val() == "" ||
    $fromYear.val() == "" ||
    $toMonth.val() == "" ||
    $toYear.val() == ""
  ) {
    alert("Please fill all fields");
  } else {
    $ele
      .find(".btn.vd_btn.vd_bg-green")
      .replaceWith(
        '<button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(' +
          $id +
          ",'emp')\">Delete</button>"
      );
    $("#employers").append(
      $(".employer_jack")
        .html()
        .replace(/__id__/g, $addCounter)
    );
    $addCounter++;
  }
}

function addEducation($id) {
  $ele = $("#edu" + $id);
  $school = $ele.find('input[name="eduschoolName[]"]');
  $gradYear = $ele.find('input[name="eduyearGrad[]"]');
  $gradMonth = $ele.find('input[name="edumonthGrad[]"]');
  $fromMonth = $ele.find('input[name="edumonthFromSchool[]"]');
  $fromYear = $ele.find('input[name="eduyearFromSchool[]"]');
  $toMonth = $ele.find('input[name="edumonthToSchool[]"]');
  $toYear = $ele.find('input[name="eduyearToSchool[]"]');
  $degree = $ele.find('input[name="eduDegree[]"]');
  if (
    $school.val() == "" ||
    $gradYear.val() == "" ||
    $gradMonth.val() == "" ||
    $fromMonth.val() == "" ||
    $fromYear.val() == "" ||
    $toMonth.val() == "" ||
    $toYear.val() == "" ||
    $degree.val() == ""
  ) {
    alert("Please fill all fields");
  } else {
    $ele
      .find(".btn.vd_btn.vd_bg-green")
      .replaceWith(
        '<button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(' +
          $id +
          ",'edu')\">Delete</button>"
      );
    $("#educations").append(
      $(".education_jack")
        .html()
        .replace(/__id__/g, $addCounter)
    );
    $addCounter++;
  }
}

function addAircraft($id) {
  $ele = $("#air" + $id);
  $make = $ele.find('input[name="manufacturer[]"]');
  $model = $ele.find('input[name="model[]"]');
  if ($make.val() == "" || $model.val() == "") {
    alert("Please fill all fields");
  } else {
    $ele
      .find(".btn.vd_btn.vd_bg-green")
      .replaceWith(
        '<button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(' +
          $id +
          ",'air')\">Delete</button>"
      );
    $("#aircrafts").append(
      $(".aircraft_jack")
        .html()
        .replace(/__id__/g, $addCounter)
    );
    $addCounter++;
  }
}

function addAircraftDepartment($id) {
  $ele = $("#air" + $id);
  $make = $ele.find('input[name="manufacturer[]"]');
  //$model = $ele.find('select[name="model[]"]');
  //$nnumber = $ele.find('input[name="nnumber[]"]');
  if ($make.val() == "") {
    // || $model.val() == '' || $nnumber.val() == ''){
    alert("Please fill all fields");
  } else {
    $ele
      .find(".remove-plane.success.fa.fa-plus")
      .replaceWith(
        '<i onclick="markDelete(' +
          $id +
          ',\'air\')" style="cursor:pointer" class="remove-plane danger fa fa-times"></i>'
      );
    $("#aircrafts").append(
      $(".aircraft_jack")
        .html()
        .replace(/__id__/g, $addCounter)
    );
    $addCounter++;
  }
}

function addAircraftFlew($id) {
  $ele = $("#air" + $id);
  $make = $ele.find('input[name="manufacturer[]"]');
  $model = $ele.find('input[name="model[]"]');
  if ($make.val() == "" || $model.val() == "") {
    alert("Please fill all fields");
  } else {
    $ele
      .find(".btn.vd_btn.vd_bg-green")
      .replaceWith(
        '<button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(' +
          $id +
          ",'air')\">Delete</button>"
      );
    $("#aircrafts_flown").append(
      $(".aircraft_jack_flew")
        .html()
        .replace(/__id__/g, $addCounter)
    );
    $addCounter++;
  }
}

function manufacturer_search($this) {
  if ($this.val().length > 2) {
    $val = $this.val();
    $object_id = $this.attr("object-id");
    console.log($baseURL + "ajax/make_model_from_nnumber/" + $val);
    $.get($baseURL + "ajax/make_model_from_nnumber/" + $val, function (json) {
      if (json.length > 0) {
        $("#suggestion_" + $object_id)
          .html(json[0].name)
          .show();
      }
    });
  }
}

$(window)
  .scroll(function () {
    /***************************** Public J **************************/

    if ($(window).scrollTop() == $(document).height() - $(window).height()) {
      publicJS.scroll($(window).scrollTop());
    }

    /***************************** Public J **************************/
  })
  .scroll();

function onLinkedInLoad() {
  var iOS = !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
  $(".ln-signup").click(function () {
    $(this).attr("disabled", "disabled");
    IN.User.authorize(function () {
      signUpCallback();
    });
    if (iOS == true) {
      localStorage.setItem("lnRefresh", "signUpCallback");
      window.location.reload(true);
    }
  });

  if (iOS == true) {
    if (
      localStorage.lnRefresh == "signUpCallback" ||
      localStorage.lnRefresh == "signInCallback"
    ) {
      $(".ln-signin,.ln-signup").attr("disabled", "disabled");
      if (IN.User.isAuthorized()) {
        var tmp = localStorage.lnRefresh;
        localStorage.setItem("lnRefresh", "false");
        if (tmp == "signUpCallback") {
          signUpCallback();
        } else {
          signInCallback();
        }
      } else {
        window.location.reload(true);
      }
    }
  }
}

function signInCallback() {
  IN.API.Profile("me")
    .fields("id", "email-address")
    .result(doSignIn)
    .error(onError);
}

function signUpCallback() {
  IN.API.Profile("me")
    .fields(
      "id",
      "first-name",
      "last-name",
      "headline",
      "location",
      "picture-url",
      "public-profile-url",
      "email-address"
    )
    .result(doSignUp)
    .error(onError);
}

// Handle the successful return from the API call
function doSignUp(data) {
  console.log(data);
  var user = data.values[0];

  $('input[name="email"]').val(user.emailAddress);
  $('input[name="password"]').val(user.id);
  $("input[name='action']").val("authLinkedIn");
  $("input[name='json']").val(JSON.stringify(user));
  if ($("#registerPilot").length > 0) {
    $('input[name="first_name"]').val(user.firstName);
    $('input[name="last_name"]').val(user.lastName);
    $('input[name="profile"]').val(user.publicProfileUrl);
    $('input[name="image"]').val(user.pictureUrl);
    $('input[name="city"]').val(user.location.name.split(",")[0]);
    $("#registerPilot input[name='json']").val(JSON.stringify(user));
    $("#registerPilot").submit();
  }

  if ($("#registerDepartment").length > 0) {
    $("#registerDepartment").submit();
  }
}

function doSignIn(data) {
  var user = data.values[0];
  $("input[name='json']").val(JSON.stringify(user));
  $("input[name='action']").val("authLinkedIn");
  //$("#userLoginEmail").val(user.emailAddress);
  //$("#userLoginPassword").val(user.id);
  $("#loginMemeber").submit();
}

// Handle an error response from the API call
function onError(error) {
  $(".ln-signup").removeAttr("disabled");
  console.log(error);
}

manualMap();

function getFlights() {
  $(".dummy-map").show();
  $("#flightDetails, #flightDataError").hide();
  $input = {
    nnumber: $("#nnumber").val(),
    date: $("#fdate").val(),
  };
  $.post("/ajax/flight_data", $input, function (response) {
    $("#flightDetails").slideDown();
    $("#flights").html("");
    if (response.status == "error" || response.data.length < 1) {
      $("#flightDataError").html(response.message).show();
    } else {
      $(".dummy-map").hide();
      $isFirst = true;
      for (let flight of response.data) {
        $("#flights").append(
          '<div style="cursor:pointer" class="well flight ' +
            ($isFirst ? "active" : "") +
            '" id="flight-' +
            flight.faFlightID +
            '" onclick="selectFlightOption($(this))">' +
            '  <input type="radio" name="flightSelected" ' +
            ($isFirst ? 'checked="checked"' : "") +
            ' value="' +
            flight.faFlightID +
            '" />' +
            '  <div class="time col-xs-5 text-right">' +
            "    <div>" +
            flight.departure +
            "</div>" +
            '      <div class="origin">' +
            flight.origin +
            "</div>" +
            "  </div>" +
            '  <div class="through col-xs-2"></div>' +
            '  <div class="time col-xs-5 text-left">' +
            "    <div>" +
            flight.arrival +
            "</div>" +
            '    <div class="origin">' +
            flight.destination +
            "</div>" +
            "  </div>" +
            '  <div class="clearfix"></div>' +
            "</div>"
        );
        $isFirst = false;
        console.log(response.data[0].mapRoute);
        updateMapperImage(response.data[0].mapRoute);
      }
    }
    $("#flightLookupButton").html("Find My Flight");
  });
}

function selectFlightOption($this) {
  $("#flightRouteError").hide();
  $("#flights .flight").removeClass("active");

  $("#flights .flight").css("background-color", "#f5f5f5");
  $this.addClass("active");
  $this.css("background-color", "#1f83ae");
  $this.find("input").prop("checked", true);

  $.get(
    "/ajax/flight_map/" + $this.find("input").val(),
    function (response) {
      $("#map").show();
      $("#collapseExample1").collapse("show");
      updateMapperImage(response);
      /*if(response.status == "error" || response.data.length < 1) {
          $('#map').hide();
          $("#flightRouteError").html(response.message).show();
        } else {
          $('#map').show();
          $('#collapseExample1').collapse('show');
          updateMapper(response.data);
        }*/
    }
  );
}

function updateMapperImage($photo) {
  $("#map").html('<img src="' + $photo + '" style="max-width: 100%;" />');
  $("#flightMAP").val($photo);
}

$flightPlanCC = [];
var map;
var places;
var autocomplete;

function updateMapper(flightPlanCoordinates) {
  $flightPlanCC = flightPlanCoordinates;
  map = new google.maps.Map(document.getElementById("map"), {
    zoom: 5,
    center: {
      lat: flightPlanCoordinates[0].lat,
      lng: flightPlanCoordinates[0].lng,
    },
    mapTypeId: "terrain",
  });

  var flightPath = new google.maps.Polyline({
    path: flightPlanCoordinates,
    geodesic: true,
    strokeColor: "#FF0000",
    strokeOpacity: 1.0,
    strokeWeight: 2,
  });

  var marker = new google.maps.Marker({
    position: flightPlanCoordinates[0],
    map: map,
    title: "Take Off",
  });

  var marker = new google.maps.Marker({
    position: flightPlanCoordinates[flightPlanCoordinates.length - 1],
    map: map,
    title: "Landing",
  });

  flightPath.setMap(map);
}

var originPin, destiNationPin, originLocation, destinationLocation;

function manualMap() {
  var manualMap = new google.maps.Map(document.getElementById("mapManual"), {
    zoom: 11,
    center: { lat: 62.323907, lng: -150.109291 },
    styles: [
      {
        elementType: "geometry",
        stylers: [
          {
            color: "#1d2c4d",
          },
        ],
      },
      {
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#8ec3b9",
          },
        ],
      },
      {
        elementType: "labels.text.stroke",
        stylers: [
          {
            color: "#1a3646",
          },
        ],
      },
      {
        featureType: "administrative",
        elementType: "geometry",
        stylers: [
          {
            visibility: "off",
          },
        ],
      },
      {
        featureType: "administrative.country",
        elementType: "geometry.stroke",
        stylers: [
          {
            color: "#4b6878",
          },
        ],
      },
      {
        featureType: "administrative.land_parcel",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#64779e",
          },
        ],
      },
      {
        featureType: "administrative.province",
        elementType: "geometry.stroke",
        stylers: [
          {
            color: "#4b6878",
          },
        ],
      },
      {
        featureType: "landscape.man_made",
        elementType: "geometry.stroke",
        stylers: [
          {
            color: "#334e87",
          },
        ],
      },
      {
        featureType: "landscape.natural",
        elementType: "geometry",
        stylers: [
          {
            color: "#023e58",
          },
        ],
      },
      {
        featureType: "poi",
        stylers: [
          {
            visibility: "off",
          },
        ],
      },
      {
        featureType: "poi",
        elementType: "geometry",
        stylers: [
          {
            color: "#283d6a",
          },
        ],
      },
      {
        featureType: "poi",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#6f9ba5",
          },
        ],
      },
      {
        featureType: "poi",
        elementType: "labels.text.stroke",
        stylers: [
          {
            color: "#1d2c4d",
          },
        ],
      },
      {
        featureType: "poi.park",
        elementType: "geometry.fill",
        stylers: [
          {
            color: "#023e58",
          },
        ],
      },
      {
        featureType: "poi.park",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#3C7680",
          },
        ],
      },
      {
        featureType: "road",
        stylers: [
          {
            visibility: "off",
          },
        ],
      },
      {
        featureType: "road",
        elementType: "geometry",
        stylers: [
          {
            color: "#304a7d",
          },
        ],
      },
      {
        featureType: "road",
        elementType: "labels.icon",
        stylers: [
          {
            visibility: "off",
          },
        ],
      },
      {
        featureType: "road",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#98a5be",
          },
        ],
      },
      {
        featureType: "road",
        elementType: "labels.text.stroke",
        stylers: [
          {
            color: "#1d2c4d",
          },
        ],
      },
      {
        featureType: "road.highway",
        elementType: "geometry",
        stylers: [
          {
            color: "#2c6675",
          },
        ],
      },
      {
        featureType: "road.highway",
        elementType: "geometry.stroke",
        stylers: [
          {
            color: "#255763",
          },
        ],
      },
      {
        featureType: "road.highway",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#b0d5ce",
          },
        ],
      },
      {
        featureType: "road.highway",
        elementType: "labels.text.stroke",
        stylers: [
          {
            color: "#023e58",
          },
        ],
      },
      {
        featureType: "transit",
        stylers: [
          {
            visibility: "off",
          },
        ],
      },
      {
        featureType: "transit",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#98a5be",
          },
        ],
      },
      {
        featureType: "transit",
        elementType: "labels.text.stroke",
        stylers: [
          {
            color: "#1d2c4d",
          },
        ],
      },
      {
        featureType: "transit.line",
        elementType: "geometry.fill",
        stylers: [
          {
            color: "#283d6a",
          },
        ],
      },
      {
        featureType: "transit.station",
        elementType: "geometry",
        stylers: [
          {
            color: "#3a4762",
          },
        ],
      },
      {
        featureType: "water",
        elementType: "geometry",
        stylers: [
          {
            color: "#0e1626",
          },
        ],
      },
      {
        featureType: "water",
        elementType: "labels.text.fill",
        stylers: [
          {
            color: "#4e6d70",
          },
        ],
      },
    ],
  });

  autocompleteOrigin = new google.maps.places.Autocomplete(
    document.getElementById("origin")
  );
  autocompleteOrigin.addListener("place_changed", function () {
    var place = autocompleteOrigin.getPlace();
    if (place.geometry) {
      originLocation = place.geometry.location;
      $("#originLat").val(originLocation.lat());
      $("#originLng").val(originLocation.lng());

      manualMap.panTo(place.geometry.location);
      manualMap.setZoom(15);
      originPin = new google.maps.Marker({
        position: place.geometry.location,
        map: manualMap,
        title: "Origin: " + place.name,
      });

      if (destinationLocation) {
        var flightPath = new google.maps.Polyline({
          path: [
            { lat: originLocation.lat(), lng: originLocation.lng() },
            { lat: destinationLocation.lat(), lng: destinationLocation.lng() },
          ],
          geodesic: true,
          strokeColor: "#FF0000",
          strokeOpacity: 1.0,
          strokeWeight: 2,
        });

        flightPath.setMap(manualMap);

        var bounds = new google.maps.LatLngBounds();
        bounds.extend(originPin.getPosition());
        bounds.extend(destiNationPin.getPosition());

        manualMap.setCenter(bounds.getCenter());
        manualMap.fitBounds(bounds);
      }
    }
  });

  autocompleteDestination = new google.maps.places.Autocomplete(
    document.getElementById("destination")
  );
  autocompleteDestination.addListener("place_changed", function () {
    var place = autocompleteDestination.getPlace();
    if (place.geometry) {
      destinationLocation = place.geometry.location;
      $("#destinationLat").val(destinationLocation.lat());
      $("#destinatinoLng").val(destinationLocation.lng());
      manualMap.panTo(place.geometry.location);
      manualMap.setZoom(15);
      destiNationPin = new google.maps.Marker({
        position: place.geometry.location,
        map: manualMap,
        title: "Destination: " + place.name,
      });

      if (originLocation) {
        var flightPath = new google.maps.Polyline({
          path: [
            { lat: originLocation.lat(), lng: originLocation.lng() },
            { lat: destinationLocation.lat(), lng: destinationLocation.lng() },
          ],
          geodesic: true,
          strokeColor: "#FF0000",
          strokeOpacity: 1.0,
          strokeWeight: 2,
        });

        flightPath.setMap(manualMap);

        var bounds = new google.maps.LatLngBounds();
        bounds.extend(originPin.getPosition());
        bounds.extend(destiNationPin.getPosition());

        manualMap.setCenter(bounds.getCenter());
        manualMap.fitBounds(bounds);
      }
    }
  });
}

function setItUp() {
  console.log(
    $("#flight-" + $("input[name=flightSelected]:checked").val())
      .wrap("<p/>")
      .parent()
      .html()
  );
  $("#flightHTML").val(
    btoa(
      $("#flight-" + $("input[name=flightSelected]:checked").val())
        .wrap("<p/>")
        .parent()
        .html()
    )
  );
}

function saveMyFlight() {
  var images = [];
  $(".image-panel-flight img").each(function () {
    images.push($(this).attr("src"));
  });

  $input = {
    type: "f",
    user_id: $user.id,
    content: $("#flightContent").val(),
    flightImages: images, //$uploadedFiles,
    flightVideos: $(".video-panel-flight").val(),
    flightVideoType: $(".video-panel-type").val(),
    flightTag: $("#flight-" + $("input[name=flightSelected]:checked").val())
      .wrap("<p/>")
      .parent()
      .html(),
    flightPath: $("#map").html(),
  };

  console.log(JSON.stringify($input));

  /*$.post($baseURL + 'post/add', $input, function (response) {
        window.location.reload(true);
        if (response.status == 'success') {
            window.location.reload(true);
        }
    }).fail(function (xhr, status, error) {
        window.location.reload(true);
    });*/
}

function saveMyFlightVFr() {
  var images = [];
  $(".image-panel-flight img").each(function () {
    images.push($(this).attr("src"));
  });

  $input = {
    type: "r",
    user_id: $user.id,
    content: $("#flightContentVFR").val(),
    flightImages: images, //$uploadedFilesVFR,
    flightVideos: $(".video-panel-flight").val(),
    flightVideoType: $(".video-panel-type").val(),
    originLat: originLocation.lat(),
    originLng: originLocation.lng(),
    destinationLat: destinationLocation.lat(),
    destinatinoLng: destinationLocation.lng(),
    flightPath: "",
  };

  console.log(JSON.stringify($input));

  /*$.post($baseURL + 'post/add', $input, function (response) {
        window.location.reload(true);
        if (response.status == 'success') {
            window.location.reload(true);
        }
    }).fail(function (xhr, status, error) {
        window.location.reload(true);
    });*/
}

function saveFlight() {
  if ($("#ifr").hasClass("btn-primary")) {
    saveMyFlight();
  } else {
    saveMyFlightVFr();
  }
}

function videoPopup($videoUrl, $poster) {
  $(".popupPlayer").lazyPlayer({
    theme: "dark",
    video: $videoUrl,
    poster: $poster,
    heading: "",
    subheading: "",
  });
  $(".wpup_fullscreen").click(function () {
    if ($(this).hasClass("wpup_active")) {
      $(".videoPopup").hide();
    }
  });
  $(".videoPopup").show();
  $(".popupPlayer .wpup_fullscreen").trigger("click");
}

document.addEventListener(
  "fullscreenchange",
  function (status) {
    var fullscreenElement =
      document.fullscreenElement ||
      document.mozFullScreenElement ||
      document.webkitFullscreenElement;
    if (fullscreenElement === null) {
      $(".videoPopup").html('<div class="popupPlayer"></div>');
      $(".videoPopup").hide();
    }
  },
  false
);

function openModalNew(target, modalPath) {
  $("#" + target + ".modal").on("show.bs.modal", function () {
    var _this = $(this);
    lastModal = _this;
    $.ajax({
      url: modalPath,
      method: "GET",
      //dataType: "html",
      data: { id: target },
      success: function (results) {
        _this.html(results);
        _this.on("hidden.bs.modal", function () {
          $(lastClickedMarker).removeClass("active");
          $(".pac-container").remove();
          _this.remove();
        });
      },
      error: function (e) {
        console.log(e);
      },
    });
  });

  $("#" + target + ".modal").modal("show");
}
