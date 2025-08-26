<!DOCTYPE html>
<!--[if IE 8]>			<html class="ie ie8"> <![endif]-->
<!--[if IE 9]>			<html class="ie ie9"> <![endif]-->
<!--[if gt IE 9]><!-->	<html><!--<![endif]-->

<!-- Specific Page Data -->
<!-- End of Data -->

<head>
    <meta charset="utf-8" />
    <title><?php echo get_title(); ?></title>
    <meta name="keywords" content="" />
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- Fav and touch icons -->
    <link rel="shortcut icon" href="/assets/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/assets/images/ico/apple-touch-icon-57-precomposed.png">
    <!-- CSS -->
    <!-- Bootstrap & FontAwesome & Entypo CSS -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <?php /*<link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/font-awesome.min.css" rel="stylesheet" type="text/css">*/ ?>
    <!--[if IE 7]><link type="text/css" rel="stylesheet" href="<?php //echo RIZ_ASSETS_BACKEND; ?>css/font-awesome-ie7.min.css"><![endif]-->

    <!-- Fonts CSS -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/fonts.css"  rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/jquery-ui/jquery-ui.custom.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/prettyPhoto-plugin/css/prettyPhoto.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/isotope/css/isotope.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/pnotify/css/pnotify.custom.min.css" media="screen" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/google-code-prettify/prettify.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/mCustomScrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/tagsInput/jquery.tagsinput.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-switch/bootstrap-switch.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS; ?>css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RIZ_ASSETS; ?>css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/trumbowyg/dist/ui/trumbowyg.css" rel="stylesheet">
    <!-- Specific CSS -->
    <!-- Theme CSS -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/theme.min.css" rel="stylesheet" type="text/css">
    <!--[if IE]> <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/ie.css" rel="stylesheet" > <![endif]-->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/chrome.css" rel="stylesheet" type="text/chrome"> <!-- chrome only css -->
    <!-- Responsive CSS -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/theme-responsive.min.css" rel="stylesheet" type="text/css">
    <!-- for specific page in style css -->
    <!-- for specific page responsive in style css -->
    <!-- Custom CSS -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/custom.css?<?php echo time(); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/theme.min.css" rel="stylesheet" type="text/css">
    <!--[if IE]> <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/ie.css" rel="stylesheet" > <![endif]-->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>css/chrome.css" rel="stylesheet" type="text/chrome"> <!-- chrome only css -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/css/nanoscroller.css" rel="stylesheet" /> <!-- chrome only css -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/css/emoji.css" rel="stylesheet" /> <!-- chrome only css -->
    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/lazyplayer/css/lazyplayer.css?<?php echo time(); ?>" rel="stylesheet" /> <!-- chrome only css -->
    <link href="<?php echo RIZ_ASSETS; ?>css/easy-autocomplete.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo RIZ_ASSETS; ?>grid/images-grid.css?<?php echo time(); ?>" rel="stylesheet" type="text/css" />

    <link href="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-wysiwyg/css/bootstrap-wysihtml5-0.0.2.css" rel="stylesheet" type="text/css">
    <!-- Head SCRIPTS -->
    <script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/mobile-detect.min.js"></script>
    <script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/mobile-detect-modernizr.js"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/html5shiv.js"></script>
    <![endif]-->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>grid/images-grid.js?<?php echo time(); ?>"></script>
    <script>
        $baseURL = '<?php echo RIZ_BASE_URL; ?>';
        <?php if(is_logged_in()): ?>
        $user = {
            id:<?php echo $this->session->userdata('user_id'); ?>,
        };
        <?php endif; ?>
    </script>
    <style>
        .image-wrap.video:before {
            content: "\f144"; /*--You can add font icon code here--*/
            font-family: FontAwesome;
            display: inline-block;
            padding-right: 6px;
            vertical-align: middle;
            font-size: 72px;
            color: rgba(222,222,222,0.8);
            position: absolute;
            z-index: 10;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>

</head>

<body id="pages" class="full-layout  nav-right-hide nav-right-start-hide  nav-top-fixed      responsive    clearfix" data-active="pages "  data-smooth-scrolling="1">
<div class="vd_body">

            <div class="vd_content-wrapper">
                <div class="vd_container">
                    <div class="vd_content clearfix">
                        <?php (isset($data)?$this->load->view($view,$data):$this->load->view($view)); ?>
                    </div>
                </div>

    </div>
  </div>






<!-- .vd_body END
<a id="back-top" href="#" data-action="backtop" class="vd_back-top visible"> <i class="fa  fa-angle-up"> </i> </a>-->

<!--
<a class="back-top" href="#" id="back-top"> <i class="icon-chevron-up icon-white"> </i> </a> -->

<!-- Javascript =============================================== -->
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/excanvas.js"></script>
<![endif]-->

<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src='<?php echo RIZ_ASSETS_BACKEND; ?>plugins/jquery-ui/jquery-ui.custom.min.js'></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/caroufredsel.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/plugins.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/breakpoints/breakpoints.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/dataTables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/prettyPhoto-plugin/js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/tagsInput/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/blockUI/jquery.blockUI.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/pnotify/js/pnotify.custom.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/select2.full.min.js"></script> <!-- Select Inputs -->
<script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/bootstrap-multiselect.js?<?php echo time(); ?>"></script> <!-- Select Inputs -->
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>js/theme.js"></script>
<script defer src="<?php echo RIZ_ASSETS_BACKEND; ?>js/fontawesome-all.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>js/dropzone.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/jquery.emojiarea.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/public.js?<?php echo time(); ?>"></script>

<script type="text/javascript" type="text/javascript" src="<?php echo RIZ_ASSETS; ?>js/custom.js?<?php echo time(); ?>"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<!-- Specific Page Scripts Put Here -->
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/isotope/isotope.pkgd.min.js"></script>
<script type="text/javascript" src='<?php echo RIZ_ASSETS_BACKEND; ?>plugins/lazyplayer/js/lazyplayer.js?<?php echo time(); ?>'></script>
<!-- Specific Page Scripts Put Here -->
<script type="text/javascript" src='<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js'></script>
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/nanoscroller.min.js"></script>
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/tether.min.js"></script>
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/config.js"></script>
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/util.js"></script>
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/jquery.emojiarea.js"></script>
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/js/emoji-picker.js"></script>
<script src="<?php echo RIZ_ASSETS; ?>js/jquery.easy-autocomplete.js"></script>
<script src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/trumbowyg/dist/trumbowyg.js"></script>


<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-wysiwyg/js/wysihtml5-0.3.0.min.js"></script>
<script type="text/javascript" src="<?php echo RIZ_ASSETS_BACKEND; ?>plugins/bootstrap-wysiwyg/js/bootstrap-wysihtml5-0.0.2.js"></script>

<script src="//rawgit.com/saribe/eModal/master/dist/eModal.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        "use strict";

        $('.wyswyg').trumbowyg();

        // init Isotope
        var $container = $('.isotope').isotope({
            itemSelector: '.gallery-item',
            layoutMode: 'fitRows'
        });
        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $container.isotope('layout');
        });
        // bind filter button click
        $('#filters').on( 'click', 'a', function() {
            var filterValue = $( this ).attr('data-filter');
            $('#filters li').removeClass('active');
            $(this).parent().addClass('active');
            $container.isotope({ filter: filterValue });
        });

    });
</script>
<!-- Specific Page Scripts END -->
<!-- Google Analytics: Change UA-XXXXX-X to be your site's ID. Go to http://www.google.com/analytics/ for more information. -->
<script>
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-43329142-3']);
    _gaq.push(['_trackPageview']);
    (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

    $(document).ready(function(){
        var options = [];

        $( '.dropdown-menu a' ).on( 'click', function( event ) {

            var $target = $( event.currentTarget ),
                val = $target.attr( 'data-value' ),
                $inp = $target.find( 'input' ),
                idx;

            if ( ( idx = options.indexOf( val ) ) > -1 ) {
                options.splice( idx, 1 );
                setTimeout( function() { $inp.prop( 'checked', false ) }, 0);
            } else {
                options.push( val );
                setTimeout( function() { $inp.prop( 'checked', true ) }, 0);
            }

            $( event.target ).blur();

            console.log( options );
            return false;
        });

        var $tmp = ['Capitan','Co-Pilot','Chief-Pilot'];

        $(".selectAircraft").select2({
            placeholder: "Choose the aircrafts",
            allowClear: true,
        }).on("change", function (e) {
            $('.selectAircraft option').each(function(){
                $(
                    '.jobTitle-'+$(this).val()+',' +
                    '.jobTitle-'+$(this).val()+'-capitan,' +
                    '.jobTitle-'+$(this).val()+'-copilot,' +
                    '.jobTitle-'+$(this).val()+'-chiefpilot'
                ).addClass('hidden');
                $this = $(this);
                $.each($tmp,function(key,val){
                    $(
                        '.jobType-'+$this.val() + '-' + val +',' +
                        '.jobType-'+$this.val() + '-' + val +'-full,' +
                        '.jobType-'+$this.val() + '-' + val +'-contract,' +
                        '.jobSalary-' + $this.val() + '-' + val + '-75k-100k,' +
                        '.jobSalary-' + $this.val() + '-' + val + '-100k-125k,' +
                        '.jobSalary-' + $this.val() + '-' + val + '-125k+'
                    ).addClass('hidden');
                });
            });

            if($(this).val().length > 0){
                $('.group-wise-select,.multiselect-native-select button').removeAttr('disabled');
                $('.multiselect-native-select button').removeClass('disabled');
                $.each($(this).val(),function(keyz,value) {
                    $(
                        '.jobTitle-' + value + ',' +
                        '.jobTitle-' + value + '-capitan,' +
                        '.jobTitle-' + value + '-copilot,' +
                        '.jobTitle-' + value + '-chiefpilot'
                    ).removeClass('hidden');
                    $.each($tmp, function (key, val) {
                        $(
                            '.jobType-'+ value + '-' + val +',' +
                            '.jobType-'+ value + '-' + val +'-full,' +
                            '.jobType-'+ value + '-' + val +'-contract,' +
                            '.jobSalary-' + value + '-' + val + ',' +
                            '.jobSalary-' + value + '-' + val + '-75k-100k,' +
                            '.jobSalary-' + value + '-' + val + '-100k-125k,' +
                            '.jobSalary-' + value + '-' + val + '-125k+'
                        ).removeClass('hidden');
                    });
                });
            }else{
                $('.group-wise-select,.multiselect-native-select button').attr('disabled');
                $('.multiselect-native-select button').addClass('disabled');
                $('.selectAircraft option').prop('selected',false);





            }

            $.each($(this).val(),function(key,val){

            });
        });
        $(".select").select2({
            allowClear: true,
        });
        $(".select-main").select2({
            allowClear: true,
            placeholder: "Who are you with?",
        });

        $('.multiselect').multiselect();
        $('.group-wise-select').multiselect({
            onChange: function(option, checked) {
                if(checked){
                    $('option.' + option[0].className).parent().find('option').each(function(){
                        $(this).prop('selected',false);
                        $('li.' + $(this).attr('class')).removeClass('active').find('input[type="checkbox"]').prop('checked',false);
                    });
                }
                $('option.' + option[0].className).prop('selected',true);
                $('li.' + option[0].className).addClass('active').find('input[type="checkbox"]').prop('checked',true);
            }
        });


        var options = {
            url: function(phrase) {
                return $baseURL + 'ajax/make_model_directory_search/' + phrase;
            },
            getValue: function(element) {
                return element.name;
            },

            list: {
                match: {
                    enabled: true
                },
                onChooseEvent: function() {
                },
            },
            theme: "square"
        };

        $(".makeModelSearch").easyAutocomplete(options);


    });

    $(function() {

        // Initializes and creates emoji set from sprite sheet
        window.emojiPicker = new EmojiPicker({
            emojiable_selector: '[data-emojiable=true]',
            assetsPath: '<?php echo RIZ_ASSETS_BACKEND; ?>plugins/emoji-picker/lib/img',
            popupButtonClasses: 'fa fa-smile-o'
        });
         window.emojiPicker.discover();

$('#description').wysihtml5();
$('#requirements').wysihtml5();

    });


</script>
</body>
</html>
