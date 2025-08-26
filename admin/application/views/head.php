<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8"/>
	<title><?php echo strtoupper($controller); ?> | Lazy-Eights.com ADMIN</title>
	
	<link rel="stylesheet" href="<?php echo RIZ_SKIN; ?>css/layout.css?<?php echo time(); ?>" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo RIZ_SKIN; ?>uploadify/uploadify.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="<?php echo RIZ_SKIN; ?>css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="<?php echo RIZ_SKIN; ?>js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="<?php echo RIZ_SKIN; ?>js/hideshow.js" type="text/javascript"></script>
	<script src="<?php echo RIZ_SKIN; ?>js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo RIZ_SKIN; ?>js/jquery.equalHeight.js"></script>
	<link rel="stylesheet" href="<?php echo RIZ_SKIN; ?>uploadify/uploadify.css" type="text/css" media="screen" />
	<script type="text/javascript" src="<?php echo RIZ_SKIN; ?>tinymce/tinymce.min.js"></script>
	<script type="text/javascript">
	tinymce.init({
	    selector: "textarea",
	    theme: "modern",
	    convert_urls: false,
	    height: 500,
	    plugins: [
	         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
	         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
	         "save table contextmenu directionality emoticons template paste textcolor"
	   ],
	   content_css: "css/content.css",
	   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
	   style_formats: [
	        {title: 'Bold text', inline: 'b'},
	        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
	        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
	        {title: 'Example 1', inline: 'span', classes: 'example1'},
	        {title: 'Example 2', inline: 'span', classes: 'example2'},
	        {title: 'Table styles'},
	        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
	    ]
	 });
	</script>
	<script type="text/javascript" src="<?php echo RIZ_SKIN; ?>uploadify/jquery.uploadify.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){ 
    	  $airports = Array();		
    	  $exterior = Array();
    	  $interior = Array();
    	  $count = 0;
      	  $(".tablesorter").tablesorter(); 
      	  $("#airfile_upload").uploadify({
      	  		fileTypeDesc    : 'Excel Files (*.xls; *.xlsx)',
				fileTypeExts         : '*.xls;*.xlsx',
      	  		swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
				uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
				removeCompleted : false,
				onQueueComplete : function(queueData){
					for($i = 0;$i < $airports.length; $i++){
						$.post('<?php echo site_url('import/airport_ajax'); ?>',{xelFile:$airports[$i]},function(data){
							$("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
							$count = $count + 1;
						});
					}
				},
				onUploadSuccess : function(file, data, response){
					$airports[$airports.length] = data;
				},
      	  });
      	  
      	  $("#aircraft_upload").uploadify({
      	  		fileTypeDesc    : 'Excel Files (*.xls; *.xlsx)',
				fileTypeExts         : '*.xls;*.xlsx',
      	  		swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
				uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
				removeCompleted : false,
				onQueueComplete : function(queueData){
					for($i = 0;$i < $airports.length; $i++){
						$.post('<?php echo site_url('import/aircraft_ajax'); ?>',{xelFile:$airports[$i]},function(data){
							$("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
							$count = $count + 1;
						});
					}
				},
				onUploadSuccess : function(file, data, response){
					$airports[$airports.length] = data;
				},
      	  });
      	  
      	  $("#exterior_upload").uploadify({
      	  		fileTypeDesc    : 'Excel Files (*.xls; *.xlsx)',
				fileTypeExts         : '*.xls;*.xlsx',
      	  		swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
				uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
				removeCompleted : false,
				onQueueComplete : function(queueData){
					
					for($i = 0;$i < $exterior.length; $i++){
						$.post('<?php echo site_url('import/exterior_ajax'); ?>',{xelFile:$exterior[$i]},function(data){
							$("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
							$count = $count + 1;
						});
					}
				},
				onUploadSuccess : function(file, data, response){
					$exterior[$exterior.length] = data;
				},
      	  });
      	  
      	  $("#interior_upload").uploadify({
      	  		fileTypeDesc    : 'Excel Files (*.xls; *.xlsx)',
				fileTypeExts         : '*.xls;*.xlsx',
      	  		swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
				uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
				removeCompleted : false,
				onQueueComplete : function(queueData){
					
					for($i = 0;$i < $interior.length; $i++){
						$.post('<?php echo site_url('import/interior_ajax'); ?>',{xelFile:$interior[$i]},function(data){
							$("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
							$count = $count + 1;
						});
					}
				},
				onUploadSuccess : function(file, data, response){
					$interior[$interior.length] = data;
				},
      	  });
      	  
      	  $("#page_editor").uploadify({
      	  		fileTypeDesc    : 'Image Files (*.png; *.jpg; *.jpeg; *.gif; *.bmp)',
				fileTypeExts         : '*.png; *.jpg; *.jpeg; *.gif; *.bmp',
      	  		swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
				uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadifyImg.php',  // The path to the server-side upload script
				buttonText: 'Add / Insert Image',
				removeCompleted : false,
				onUploadSuccess : function(file, data, response){
					tinyMCE.activeEditor.execCommand('mceInsertContent', false, '<img src="' + data + '" />');
				},
      	  });
      	  
      	  $(".delete").click(function(){
      	  	$this = $(this);
      	  	if(confirm('Are you sure you want to delete?')){
      	  		$.post('<?php echo site_url('enlist/delete'); ?>',{controller : '<?php echo $controller; ?>',val : $(this).attr('href')},function(data){
      	  			if(data == 1){
      	  				$this.parent().parent().remove();
      	  			}
      	  		});
      	  	}
      	  	return false;
      	  });
		$pilot_files = [];
		$("#pilot_upload").uploadify({
			fileTypeDesc    : 'Excel Files (*.xls; *.xlsx)',
			fileTypeExts         : '*.xls;*.xlsx',
			swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
			uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
			removeCompleted : false,
			onQueueComplete : function(queueData){
				for($i = 0;$i < $pilot_files.length; $i++){
					$.post('<?php echo site_url('import/pilot_ajax'); ?>',{xelFile:$pilot_files[$i]},function(data){
						$("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
						$count = $count + 1;
					});
				}
			},
			onUploadSuccess : function(file, data, response){
				$pilot_files[$pilot_files.length] = data;
			},
		});

		$("#department_upload").uploadify({
			fileTypeDesc    : 'Excel Files (*.xls; *.xlsx), CSV (*.csv)',
			fileTypeExts         : '*.xls;*.xlsx;*.csv',
			swf      : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.swf',  // The path to the uploadify SWF file
			uploader : '<?php echo RIZ_SKIN; ?>uploadify/uploadify.php',  // The path to the server-side upload script
			removeCompleted : false,
			onQueueComplete : function(queueData){
				for($i = 0;$i < $interior.length; $i++){
					$.post('<?php echo site_url('import/department_ajax'); ?>',{xelFile:$interior[$i]},function(data){
						console.log(data);
						$("#SWFUpload_0_" + $count).css('background-color','#097054').css("color","#fff").children('.data').html(' - Imported');
						$count = $count + 1;
					});
				}
			},
			onUploadSuccess : function(file, data, response){
				$interior[$interior.length] = data;
			},
		});
   	});
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

</head>


<body>

	<header id="header">
		<hgroup>
			<h1 class="site_title"><a href="index.html"><?php echo RIZ_SITE_NAME; ?></a></h1>
			<h2 class="section_title">
<?php if($controller == 'piolet'){ $controller ='Pilot/Detailers';
}else if($controller == 'owner'){ $controller ='Aircraft Owners';
}else if($controller == 'order'){ $controller ='Postcard Marketing Orders';
}else if($controller == 'product'){ $controller ='Product Line and Orders';
}else if($controller == 'product_order'){ $controller ='Product Orders';
}else if($controller == 'job '){ $controller ='Jobs Board Postings';
}else if($controller == 'quote'){ $controller ='Estimates';
}else if($controller == 'application'){ $controller ='Applications Against Work Orders';
}else if($controller == 'aircraft'){ $controller ='Aircraft for Marketing Map';
}else if($controller == 'airport'){ $controller ='Airports for Marketing Map';
}else if($controller == 'maker'){ $controller ='Aircraft Make for Estimates';
}else if($controller == 'model'){ $controller ='Aircraft Model for Estimates';
}else if($controller == 'exterior'){ $controller ='Exterior Price Guide';
}else if($controller == 'interior'){ $controller ='Interior Price Guide';
}else if($controller == 'package'){ $controller ='Postcard Price Guide';
}else if($controller == 'user'){ $controller ='Users';
}else if($controller == 'cms'){ $controller ='CMS';}

?>

<?php echo (isset($type)?strtoupper($type):strtoupper($controller)); ?></h2>


<div class="btn_view_site"><a href="<?php echo RIZ_SITE_URL; ?>" target="_blank">View Site</a></div>
		</hgroup>
	</header> <!-- end of header bar -->
	
	<section id="secondary_bar">
		<div class="user">
			<p>John Doe (<a href="<?php echo site_url('user/logout'); ?>">Logout</a>)</p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"><a href="index.html"><?php echo RIZ_SITE_NAME; ?></a> <div class="breadcrumb_divider"></div> <a class="current"><?php echo strtoupper($controller); ?></a></article>
		</div>
	</section><!-- end of secondary bar -->
	
	<aside id="sidebar" class="column">
		<h3><a href="<?php echo site_url('user/dashboard'); ?>">DASHBOARD</a></h3>
		
        	        	<?php menus();?>

    <ul>
    <li><a href="http://registry.faa.gov/database/CS032016.zip">Download FAA DB</a>
    </li>
    <li><a href="<?php echo site_url('../../index.php/registerpilots/uploaddb');?>">upload Pilot_basic DB</a>
    </li><li><a href="<?php echo site_url('../../index.php/registerpilots/uploadflightdb');?>">upload Flightdepartment DB</a>
    </li>
        </ul>
		
		
		<footer>
			<hr />
			<p><strong>Copyright &copy; <?php echo date('Y'); ?> <?php echo RIZ_SITE_NAME; ?></strong></p>
		</footer>
	</aside><!-- end of sidebar -->
	
	<section id="main" class="column">
		<?php echo (isset($success_msg)?get_message($success_msg):''); ?>
