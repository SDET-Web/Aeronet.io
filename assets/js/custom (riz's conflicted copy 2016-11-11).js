$(document).ready(function(){

    $manufacturer = '';
    publicJS.init();
    $('.select_all').click(function(){
        if($(this).prop('checked') == true){
            $('.select_check').each(function(){
                $(this).prop('checked',true);
            });
        }else{
            $('.select_check').each(function(){
                $(this).prop('checked',false);
            });
        }
    });

    tinymce.init({
        selector: '.myeditablediv'
    });


    $('#add-news-article').click(function(){
        $('.new-add-edit').toggleClass('hidden');
    });

   $('.manufacturer').each(function() {
       $(this).html($('.manufacturer-select').html());
       $(this).val($(this).attr('selected-object'));
       $model = $($(this).attr('connected-model'));
       $.get($baseURL + 'ajax/model_directory/' + $(this).val(),function($data){
            $model.html($data);
           $model.val($(this).attr('selected-object'));
       });
   });


    $('.emojis-plain').emojiarea({wysiwyg: false});

    $('.html-editor').keyup(function(event){
        if(event.keyCode == 13){
            $(this).append('<br />');
            $('#' + $(this).attr('text-id')).val('<br />');
        }else if(event.keyCode == 8) {

        }else if(event.keyCode == 32) {
            $(this).append('&nbsp;');
            $('#' + $(this).attr('text-id')).val('&nbsp;');
        }else{
            $(this).append(event.key);
            $('#' + $(this).attr('text-id')).val(event.key);
        }
        return false;
    });

    $('#post-it').click(function(){
        if($('#post-content').val() != ''){
            $.post($baseURL + 'post/add',{type:'s',user_id:$user.id,content:$('#post-content').val() + $('.image-panel').html()},function(response){
                if(response.status == 'success'){
                    window.location.reload(true);
                }
            });
        }
    });
    
    $('')

    
    $('#post-article').click(function(){
        if(tinymce.activeEditor.getContent() != ''){
            $.post($baseURL + 'post/add',{type:'n',user_id:$user.id,content:tinymce.activeEditor.getContent()},function(response){
                if(response.status == 'success'){
                    window.location.reload(true);
                }
            });
        }
    });

    $('#save-article').click(function(){
        if(tinymce.activeEditor.getContent() != ''){
            $.post($baseURL + 'post/add',{type:'n',user_id:$user.id,content:tinymce.activeEditor.getContent(),id:$('#new-id').val()},function(response){
                if(response.status == 'success'){
                    window.location.reload(true);
                }
            });
        }
    });


    $('#filetoattach').change(function(){
        var files = event.target.files;
        for (var i = 0, f; f = files[i]; i++) {
            if (!f.type.match('image.*')) {
                continue;
            }
            var reader = new FileReader();
            reader.onload = (function(theFile) {
                return function(e) {
                    $('.image-panel').append('<img src="' + e.target.result + '"/>');
                };
            })(f);
            reader.readAsDataURL(f);
        }
    });

    $("#uploadPhotos").dropzone({ url: "upload/photo/" +  $user.id, success: function(data,response){
    }, queuecomplete : function () {
        $.get($baseURL + 'post/photo/' + $user.id,function(resonse){
            window.location.reload(true);
            //console.log(resonse);
        });
    }});



    $('.manufacturer-autocomplete').keyup(function(){
        if($(this).val().length > 2){
            $this = $(this);
            $object_id = $(this).attr('object-id');
            $.get($baseURL + 'ajax/make_directory/' + $(this).val(),function(json){
                $('#suggestion_' + $object_id).html('').show();
                for($i = 0; $i < json.length; $i++){
                    $('#suggestion_' + $object_id).append('<li onclick="updateModel(\'' + json[$i] + '\',$object_id)">' + json[$i] + '</li>');
                }
            });
        }
    });

    $('#companyname').keyup(function(){
        $.get($baseURL + 'ajax/department_directory/' + $(this).val(),function(json){
            $('.companyname_suggestion').html('');
            if(json.data.length > 0){
                $('#search-regsiter-button').html('Search Now');
                for($i = 0; $i < json.data.length; $i++){
                    jQuery('.companyname_suggestion').append('<li onclick="putsuggestion(\'' + json.data[$i].title + '\')">' + json.data[$i].title + '</li>');
                }
            }else{
                $('#search-regsiter-button').html('Create Flight Department');
            }
        });
    });

    $('.connect').click(function(){
        $_this = $(this);
        $.get($baseURL + 'connect/' + $(this).attr('object-id') + '/' + $user.id,function(response){
            if(response.message == "success"){
                $_this.parent().parent().fadeOut();
            }
        });
        return false;
    });

    $('.connect_big').click(function(){
        $_this = $(this);
        $.get($baseURL + 'connect/' + $(this).attr('object-id') + '/' + $user.id,function(response){
            if(response.message == "success"){
                window.location.reload();
            }
        });
        return false;
    });
    
    $('.follow').click(function() {
        $_this = $(this);
        $.get($baseURL + 'follow/' + $(this).attr('object-id') + '/' + $user.id, function (response) {
            if (response.message == "success") {
                $_this.parent().parent().fadeOut();
            }
        });
        return false;
    });

    $('.follow_big').click(function() {
        $_this = $(this);
        $.get($baseURL + 'follow/' + $(this).attr('object-id') + '/' + $user.id, function (response) {
            if (response.message == "success") {
                window.location.reload();
            }
        });
        return false;
    });


    $('.unfollow-user').click(function(){
        $_this = $(this);
        $.get($baseURL + 'unfollow/' + $(this).attr('object-id') + '/' + $user.id,function(response){
            console.log(response);
            if(response.status == "success"){
                $_this.parent().parent().parent().parent().parent().parent().fadeOut();
            }
        });
    });

    $('.accept-user').click(function(){
        $_this = $(this);
        $.get($baseURL + 'accept/' + $(this).attr('object-id') + '/' + $user.id,function(response){
            console.log(response);
            if(response.status == "success"){
                window.location.reload(true);
            }
        });
    });

    $('.decline-user').click(function(){
        $_this = $(this);
        $.get($baseURL + 'decline/' + $(this).attr('object-id') + '/' + $user.id,function(response){
            console.log(response);
            if(response.status == "success"){
                window.location.reload(true);
            }
        });
    });

    $('#wizard-3').bootstrapWizard({
        'tabClass': 'nav nav-pills nav-justified',
        'nextSelector': '.wizard .next',
        'previousSelector': '.wizard .prev',
        'onTabShow' : function(){
            $('#wizard-3 .finish').hide();
            $('#wizard-3 .next').show();
            if ($('#wizard-3 .nav li:last-child').hasClass('active')){
                $('#wizard-3 .next').hide();
                $('#wizard-3 .finish').show();
            }
        },
        'onNext': function(){
            scrollTo('#wizard-3',-100);
        },
        'onPrevious': function(){
            scrollTo('#wizard-3',-100);
        }
    });


    



});

function putsuggestion($val){
    $('#companyname').val($val);
    $('.companyname_suggestion').hide();
}

function updateModel($val,$id){
    $('#manufacturer_' + $id).val($val);
    $('#suggestion_' + $id).html('').hide();
    $.get($baseURL + 'ajax/model_directory/' + $val,function(json){
        $('.model-' + $id).html(json);
    });
}

$addCounter = 2;

function markDelete($id,$type){
    $('#' + $type + $id).hide();
    $('#' + $type + 'status' + $id).val('delete');
}

function addEmployee($id){
    $ele = $('#emp' + $id);
    $company = $ele.find('input[name="empcompanyName[]"]');
    $title = $ele.find('input[name="empjobTitle[]"]');
    $fromMonth = $ele.find('input[name="empmonthFormJob[]"]');
    $fromYear = $ele.find('input[name="empyearFormJob[]"]');
    $toMonth = $ele.find('input[name="empmonthToJob[]"]');
    $toYear = $ele.find('input[name="empyearToJob[]"]');
    $duties = $ele.find('input[name="empjobDuties[]"]');
    if($company.val() == '' || $title.val() == '' || $fromMonth.val() == '' || $fromYear.val() == '' || $toMonth.val() == '' || $toYear.val() == ''){
        alert('Please fill all fields');
    }else{
        $ele.find('.btn.vd_btn.vd_bg-green').replaceWith('<button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(' + $id +',\'emp\')">Delete</button>');
        $('#employers').append($('.employer_jack').html().replace(/__id__/g,$addCounter));
        $addCounter++;
    }
}

function addEducation($id){
    $ele = $('#edu' + $id);
    $school = $ele.find('input[name="eduschoolName[]"]');
    $gradYear = $ele.find('input[name="eduyearGrad[]"]');
    $gradMonth = $ele.find('input[name="edumonthGrad[]"]');
    $fromMonth = $ele.find('input[name="edumonthFromSchool[]"]');
    $fromYear = $ele.find('input[name="eduyearFromSchool[]"]');
    $toMonth = $ele.find('input[name="edumonthToSchool[]"]');
    $toYear = $ele.find('input[name="eduyearToSchool[]"]');
    $degree = $ele.find('input[name="eduDegree[]"]');
    if($school.val() == '' || $gradYear.val() == '' || $gradMonth.val() == '' || $fromMonth.val() == '' || $fromYear.val() == '' || $toMonth.val() == '' || $toYear.val() == '' || $degree.val() ==''){
        alert('Please fill all fields');
    }else{
        $ele.find('.btn.vd_btn.vd_bg-green').replaceWith('<button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(' + $id +',\'edu\')">Delete</button>');
        $('#educations').append($('.education_jack').html().replace(/__id__/g,$addCounter));
        $addCounter++;
    }
}

function addAircraft($id){
    $ele = $('#air' + $id);
    $make = $ele.find('input[name="manufacturer[]"]');
    $model = $ele.find('input[name="model[]"]');
    if($make.val() == '' || $model.val() == ''){
        alert('Please fill all fields');
    }else{
        $ele.find('.btn.vd_btn.vd_bg-green').replaceWith('<button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(' + $id +',\'air\')">Delete</button>');
        $('#aircrafts').append($('.aircraft_jack').html().replace(/__id__/g,$addCounter));
        $addCounter++;
    }
}

function addAircraftDepartment($id){
    $ele = $('#air' + $id);
    $make = $ele.find('input[name="manufacturer[]"]');
    $model = $ele.find('select[name="model[]"]');
    $nnumber = $ele.find('input[name="nnumber[]"]');
    if($make.val() == '' || $model.val() == '' || $nnumber.val() == ''){
        alert('Please fill all fields');
    }else{
        $ele.find('.remove-plane.success.fa.fa-plus').replaceWith('<i onclick="markDelete(' + $id + ',\'air\')" style="cursor:pointer" class="remove-plane danger fa fa-times"></i>');
        $('#aircrafts').append($('.aircraft_jack').html().replace(/__id__/g,$addCounter));
        $addCounter++;
    }
}

function addAircraftFlew($id){
    $ele = $('#air' + $id);
    $make = $ele.find('input[name="manufacturer[]"]');
    $model = $ele.find('input[name="model[]"]');
    if($make.val() == '' || $model.val() == ''){
        alert('Please fill all fields');
    }else{
        console.log($ele.html());
        $ele.find('.btn.vd_btn.vd_bg-green').replaceWith('<button type="button" class="btn vd_btn vd_bg-red" onclick="markDelete(' + $id +',\'air\')">Delete</button>');
        $('#aircrafts_flown').append($('.aircraft_jack_flew').html().replace(/__id__/g,$addCounter));
        $addCounter++;
    }
}

function manufacturer_search($this){
    if($this.val().length > 2){
        $object_id = $this.attr('object-id');
        $.get($baseURL + 'ajax/make_directory/' + $this.val(),function(json){
            $('#suggestion_' + $object_id).html('').show();
            for($i = 0; $i < json.length; $i++){
                $('#suggestion_' + $object_id).append('<li onclick="updateModel(\'' + json[$i] + '\',$object_id)">' + json[$i] + '</li>');
            }
        });
    }
}

$(window).scroll(function() {

    /***************************** Public J **************************/

    if ($(window).scrollTop() == ($(document).height() - $(window).height())) {
        publicJS.scroll($(window).scrollTop());
    }

    /***************************** Public J **************************/

}).scroll();
