var thisPageUsingOtherJSLibrary = false;



if (typeof jQuery == 'undefined') {
    if (typeof $ == 'function') {
        thisPageUsingOtherJSLibrary = true;
    }

    function getScript(url, type) {
        var script     = document.createElement(type);
        if(type == "script"){
            script.src = url;
        }else{
            script.href = url;
            script.type = "text/css";
            script.rel = "stylesheet";
        }
        var head = document.getElementsByTagName('head')[0],
            done = false;
        // Attach handlers for all browsers
        script.onload = script.onreadystatechange = function() {
            if (!done && (!this.readyState || this.readyState == 'loaded' || this.readyState == 'complete')) {
                done = true;
                if (typeof jQuery=='undefined') {
                    alert('Please enable Javascript');
                } else {
                    //fancyCode();
                    if (thisPageUsingOtherJSLibrary) {
                        initInJQuery();
                    } else {
                        initInJQuery(true);
                    }
                }
                script.onload = script.onreadystatechange = null;
                head.removeChild(script);
            };
        };
        head.appendChild(script);
    };
    getScript('http://code.jquery.com/jquery-1.11.3.min.js','script');
} else {
    initInJQuery();
};


function initInJQuery() {
    jQuery('head').append('<link href="<?php echo SITE_URL; ?>/css.css" type="text/css" rel="stylesheet" />');
    var gmwJS = function () {

        /********************************************************************************/
        /* 									GLOBAL VARIABLES 							*/
        /********************************************************************************/
        $page = 0;
        $type = 'browse_article';
        $sort = 'asc';
        $term = '';
        $alpha = '';
        $isBlock = false;
        $topicStack = [];
        $currentTopic = 0;


        /********************************************************************************/
        /* 									GENERAL FUNCTIONS							*/
        /********************************************************************************/

        var makeCall = function ($url, $data, $callBack) {
            jQuery('.gmw-spinner').removeClass('gmw-display-none');
            jQuery.get($url,$data,$callBack);
        };

        var resetCall = function(){
            $page = 0;
            $sort = jQuery('.gmw-sort-by').val();
            $term = jQuery('.gmw-search').val();
            $type = jQuery('.gmw-search-type').val();
            $alpha = jQuery('.gmw-alpha li.gmw-active').html();
            jQuery('.gmw-aplah-topic').html('');
        };

        var hideViews = function(){
            jQuery('.gmw-list-view').addClass('gmw-display-none');
            jQuery('.gmw-topic').addClass('gmw-display-none');
            jQuery('.gmw-landing').addClass('gmw-display-none');
        }


        var listTopic = function(){
            makeCall('<?php echo SITE_URL; ?>/articles/?key=<?php echo $this->input->get('auth'); ?>&alpha=' + $alpha + '&sort=' + $sort + '&page=' + $page + '&term=' + $term,{},renderDataList);
        };

        var listIndex = function(){
            makeCall('<?php echo SITE_URL; ?>/indices/?key=<?php echo $this->input->get('auth'); ?>&alpha=' + $alpha + '&sort=' + $sort + '&page=' + $page + '&term=' + $term,{},renderIndexList);
        };

        var popupList = function(){
            if($isBlock == false && location.hash != '#landing'){
                hideViews();
                jQuery('.gmw-list-view').removeClass('gmw-display-none');
                if($type == 'index'){
                    jQuery('.gmw-heading').html('Indexes');
                    listIndex();
                }else{
                    jQuery('.gmw-heading').html('Articles');
                    listTopic();
                }
            }
        };

        var singleTopic = function($id,$dont_push){
            $isBlock = true;
            hideViews();
            jQuery('.gmw-topic').removeClass('gmw-display-none');
            makeCall('<?php echo SITE_URL; ?>/articles/' + $id + '/?key=<?php echo $this->input->get('auth'); ?>',{},renderData);
            location.hash = $id;
        };

        var singleReference = function($id){
            $isBlock = true;
            jQuery('.gmw-reference').removeClass('gmw-display-none');
            makeCall('<?php echo SITE_URL; ?>/references/' + $id + '/?key=<?php echo $this->input->get('auth'); ?>',{},renderReference);
        };

        var scrollReferences = function($id){

        };

        return {

            init : function(){
                $page = 0;
                popupList();

                $alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split("");
                for($i = 0; $i < 26; $i++) {
                    jQuery('.gmw-alpha-select').append('<option value="' + $alphabet[$i] + '">' + $alphabet[$i] + '</option>');
                }

                jQuery('.gmw-alpha li').each(function(){
                    jQuery(this).addClass($(this).html());
                });

                jQuery('.gmw-alpha-select').change(function(){
                    $isBlock = false;
                    location.hash = '#search';
                    jQuery('.gmw-list-view').removeClass('gmw-display-none');
                    jQuery('.gmw-topic').addClass('gmw-display-none');
                    jQuery('.gmw-search').val('');
                    resetCall();
                    jQuery('.gmw-alpha li').removeClass('gmw-active');
                    jQuery('.gmw-alpha li.' + jQuery(this).val()).addClass('gmw-active');
                    $alpha = jQuery('.gmw-alpha li.gmw-active').html();
                    popupList();
                });


                jQuery('.gmw-alpha li').click(function(){
                    $isBlock = false;
                    location.hash = '#search';
                    jQuery('.gmw-list-view').removeClass('gmw-display-none');
                    jQuery('.gmw-topic').addClass('gmw-display-none');
                    jQuery('.gmw-search').val('');
                    resetCall();
                    jQuery('.gmw-alpha li').removeClass('gmw-active');
                    jQuery(this).addClass('gmw-active');
                    $alpha = jQuery('.gmw-alpha li.gmw-active').html();
                    popupList();
                });

                jQuery('.gmw-sort-by').change(function(){
                    resetCall();
                    popupList();
                });

                jQuery('.gmw-search').keyup(function(){
                    if(jQuery('.gmw-search').val().length > 3 || jQuery('.gmw-search').val() == ''){
                        $alpha = '';
                        jQuery('.gmw-alpha li').removeClass('gmw-active');
                        jQuery('.gmw-alpha li:first-child').addClass('gmw-active');
                        jQuery('.gmw-list-view').removeClass('gmw-display-none');
                        jQuery('.gmw-topic').addClass('gmw-display-none');
                        resetCall();
                        $isBlock = false;
                        popupList();
                    }
                });

                jQuery('.gmw-search-type').change(function(){
                    resetCall();
                    popupList();
                });

                jQuery('.gmw-aplah-topic').on("click",".gmw-single-topic", function(){
                    singleTopic(jQuery(this).attr('data-id'));
                });

                jQuery('.gmw-topic-content').on("click","a", function(){
                    if(jQuery(this).hasClass('reference-transfer')){
                        singleReference(jQuery(this).attr('href'));
                    }else if(jQuery(this).hasClass('reference')){
                        jQuery('.reference-transfer').removeClass('active');
                        jQuery('#' + jQuery(this).find('.pre').html().replace('[','').replace(']','')).addClass('active');
                        jQuery('html,body').animate({
                            scrollTop: jQuery('.ref-container').offset().top
                        }, 1000);
                    }else{
                        singleTopic(jQuery(this).attr('href'));
                        jQuery('html,body').animate({
                            scrollTop: jQuery('html').offset().top
                        }, 1000);
                    }
                    return false;
                });

                jQuery('.gmw-close-reference').click(function(){
                    jQuery('.gmw-reference').addClass('gmw-display-none');
                });

                jQuery('.gmw-back').click(function(){
                    window.history.back();
                });

                hideViews();
                jQuery('.gmw-landing').removeClass('gmw-display-none');
            },

            update : function(){
                if(location.hash == '#search'){
                    jQuery('.gmw-list-view').removeClass('gmw-display-none');
                    jQuery('.gmw-topic').addClass('gmw-display-none');
                    popupList();
                }else if(location.hash == '#landing'){
                    hideViews();
                    jQuery('.gmw-landing').removeClass('gmw-display-none');
                }else{
                    $str = location.hash;
                    singleTopic($str.substring(1,$str.length),false);
                }
            },

            scroll: function(scrollPos){
                $page = $page + 1;
                popupList();
            },
        }
    }();



    jQuery('document').ready(function(){
        location.hash = '#<?php echo isset($start) && $start != 0?'landing':'search'; ?>';
        $ele = jQuery('#gmw-container');
        // Extend width to parent
        $ele.width($ele.parent().width() - 20).height($ele.parent().height());
        if($ele.parent().width() - 20 >= 800 && $ele.parent().width() - 20 < 1024){
            $ele.addClass('medium-body');
        }else if($ele.parent().width() - 20 < 800){
            $ele.addClass('small-body');
        }
        $ele.html(
                    '<div class="gmw-container">'
                    +'   <div class="gmw-width-full gmw-marg-top gmw-pad">'
                    //+'       <h1 class="gmw-text-center">Green Medicine Works</h1>'
                    +'       <div class="gmw-width-50-float gmw-div-center gmw-marg-top">'
                    +'           <div class="gmw-container-1 gmw-div-center">'
                    +'               <span class="icon gmw-icon"><i class="fa fa-search"></i></span>'
                    +'               <input type="search" class="gmw-search" placeholder="Search..." />'
                    +'               <select class="gmw-search-type gmw-display-none">'
                    +'                   <option value="article">Topics</option>'
                    +'                   <option value="index">Index</option>'
                    +'               </select>'
                    +'               <span class="icon gmw-icon gmw-dropdown-icon gmw-display-none"><i class="fa fa-sort-desc"></i></span>'
                    +'           </div>'
                    +'       </div>'
                    +'       <div class="gmw-clearfix"></div>'
                    +'       <div class="gmw-with-100 gmw-main-content">'
                    +'          <div class="gmw-with-100 gmw-sort-strip">'
                    +'              <ul class="gmw-flat-list gmw-alpha">'
                    +'                  <li class="gmw-active">All</li><li>A</li><li>B</li><li>C</li><li>D</li><li>E</li><li>F</li><li>G</li><li>H</li><li>I</li><li>J</li><li>K</li><li>L</li><li>M</li><li>N</li><li>O</li><li>P</li><li>Q</li><li>R</li><li>S</li><li>T</li><li>U</li><li>V</li><li>W</li><li>X</li><li>Y</li><li>Z</li>'
                    +'              </ul><div class="clear-it"></div>'
                    +'              <select class="gmw-float-left gmw-alpha-select gmw-hidden"><option selected="selected" value="All">Filter Alphabetically</option></select>'
                    +'              <select class="gmw-float-right gmw-sort-by">'
                    +'                  <option selected="selected" value="asc">A to Z</option>'
                    +'                  <option value="desc">Z to A</option>'
                    +'              </select><div class="clear-it"></div>'
                    +'          </div>'
                    +'          <div class="gmw-with-100 gmw-list-view gmw-display-none">'
                    +'              <div class="gmw-clearfix pad">&nbsp;</div>'
                    +'              <h1 class="gmw-heading">Articles</h1>'
                    +'              <ul class="gmw-flat-list gmw-aplah-topic"></ul><div class="gmw-clearfix gmw-end-of-list"></div>'
                    +'              <div class="gmw-spinner gmw-display-none"><div><i class="fa fa-circle-o-notch fa-spin"></i>Loading</div></div>'
                    +'          </div>'
                    +'          <div class="gmw-topic gmw-display-none">'
                    +'               <div class="gmw-back" style="padding-top:20px;"><i class="fa fa-arrow-left"></i> Back</div><div class="clear-it"></div>'
                    +'               <div class="gmw-spinner gmw-display-none"><div><i class="fa fa-circle-o-notch fa-spin"></i>Loading</div></div><div class="clear-it"></div>'
                    +'               <div class="gmw-topic-content"></div>'
                    +'           </div>'
                    +'          <div class="gmw-with-100 gmw-landing"><?php echo '<h1 style="text-align: center;">' . $article['title'] . '</h1>' . preg_replace('/\s+/S', " ", $article['data']); ?></div>'
                    +'       </div>'
                    +'       <div class="gmw-clearfix"></div>'
                    +'   </div>'
                    +'  <div class="gmw-reference gmw-display-none"><i class="fa fa-times gmw-close-reference"></i><div class="gmw-reference-content"></div></div>'
                    +'</div>'
        );
        // Initialize
        gmwJS.init();


        window.onhashchange = function() {
            gmwJS.update();
        }

    });

    jQuery(window).scroll(function() {
        if(jQuery('.gmw-end-of-list').position()!=undefined){
           if (jQuery(window).scrollTop() >= (jQuery('.gmw-end-of-list').position().top - jQuery(window).height() + 50)) {
                gmwJS.scroll(jQuery(window).scrollTop());
            }
        }
    }).scroll();

}



function renderDataList(response){
    jQuery('.gmw-spinner').addClass('gmw-display-none');
    if(response.message == 'success'){
        for(i = 0;i < response.data.length; i++){
            jQuery('.gmw-aplah-topic').append('<li class="gmw-single-topic" data-id="' + response.data[i].href + '">' + response.data[i].title + '</li>');
        }
    }
}
function renderIndexList(response){
    jQuery('.gmw-spinner').addClass('gmw-display-none');
    if(response.message == 'success'){
        for(i = 0;i < response.data.length; i++){
            jQuery('.gmw-aplah-topic').append('<li class="gmw-single-topic" data-id="' + response.data[i].href + '">' + response.data[i].title + '</li>');
        }
    }
}
function renderData(response){
    jQuery('.gmw-spinner').addClass('gmw-display-none');
    if(response.message == 'success'){
        $data = response.data.data.replace(/\<pre/g, '<span');
        jQuery('.gmw-topic-content').html('<h1>' + response.data.title + '</h1>' + $data);
    }
}
function renderReference(response){
    jQuery('.gmw-spinner').addClass('gmw-display-none');
    if(response.message == 'success'){
        jQuery('.gmw-reference-content').html(response.data.data);
    }
}