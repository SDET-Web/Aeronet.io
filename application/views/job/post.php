<link rel="stylesheet" type="text/css" media="all" href="/skin/css/jsDatePick_ltr.min.css" />
<!-- 
	OR if you want to use the calendar in a right-to-left website
	just use the other CSS file instead and don't forget to switch g_jsDatePickDirectionality variable to "rtl"!
	
	<link rel="stylesheet" type="text/css" media="all" href="jsDatePick_ltr.css" />
-->
<script type="text/javascript" src="/skin/js/jsDatePick.min.1.3.js"></script>
<!-- 
	After you copied those 2 lines of code , make sure you take also the files into the same folder :-)
    Next step will be to set the appropriate statement to "start-up" the calendar on the needed HTML element.
    
    The first example of Javascript snippet is for the most basic use , as a popup calendar
    for a text field input.
-->
<script type="text/javascript">
	window.onload = function(){
		new JsDatePick({
			useMode:2,
			target:"open",
			dateFormat:"%d/%M/%Y",
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"ocean_blue",
			imgPath:"/skin/pic/img/",
			weekStartDay:1
			/*selectedDate:{				This is an example of what the full configuration offers.
				day:5,						For full documentation about these settings please see the full version of the code.
				month:9,
				year:2006
			},
			yearsRange:[1978,2020],
			limitToToday:false,
			cellColorScheme:"ocean_blue",
			dateFormat:"%m-%d-%Y",
			imgPath:"img/",
			weekStartDay:1*/
		});
	};
</script>
<?php //if($this->input->post('action') != 'postJob'){ ?>
<?php $this->Model_form->post_job($int_ext); ?>
<?php //}else{ ?>
<?php //$this->Model_form->post_job_two($aircraft); ?>
<?php //} ?>
<script>
	$('#aircraftModel').change(function(){
		window.location = '?make=' + $('#aircraftMake').val() + '&model=' + $(this).val();
	})
</script>
<div class="relative_image" id="exWW" style="background-color:#10243f;width:400px;height:200px;margin-left:-200px;margin-top:-125px">
				<h2>WET WASH<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
				<p> Complete exterior wet wash of aircraft, using aircraft detergents. The Aircraft is dried with neoprene
squeegees and chamois to a spot free finish.
<br /><a href="<?php echo site_url('product'); ?>?p=p1" class="color-blue">Safety Wash</a> is Recommended</p>

		</div>
		
<div class="relative_image" id="exDW" style="background-color:#10243f;width:500px;height:200px;margin-left:-250px;margin-top:-125px">
				<h2>DRY WASH<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
<p>An outstanding way to maintain the exterior of your aircraft when access to an airport washing station
is unavailable or when airport EPA regulations will not allow wet washing. Dry washing chemicals remove carbon
exhaust, bugs, and smudges; all while leaving your finish waxed.<br />
<a href="<?php echo site_url('product'); ?>?p=p3" class="color-blue">Power Foam</a>, <a href="<?php echo site_url('product'); ?>?p=p2" class="color-blue">Quick Turn</a>, and <a href="<?php echo site_url('product'); ?>?p=p4" class="color-blue">Ultra Magnum</a> are Recommended</p>
		</div>

<div class="relative_image" id="exPN" style="background-color:#10243f;width:700px;height:400px;margin-left:-350px;margin-top:-225px">
				<h2>PAINT<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
<p>Entire aircraft is waxed using an aviation quality Carnauba Enriched cleaner wax. The result is a clean protected high gloss finish.
<br /><a href="<?php echo site_url('product'); ?>?p=p5" class="color-blue">Flyers Speed Wax</a> is Recommended</p>

<p><strong>PAINT REJUVENATION:</strong> 2 STEP SYSTEM resulting in a quality paint job.</p>
<p>1) Paint is polished by hand with a paint prep cleaner wax . Color brighteners restore paint and make colors pop,
while UV protectors help prevent future sun damage.<br />
<a href="<?php echo site_url('product'); ?>?p=p6" class="color-blue">Supreme Glaze</a> is recommended.</p>
<p>2) The clean paint is followed bcy a paint sealant. Paint sealants chemically bonds to the aircraft. The result is a
ultra-high gloss protected finish.<br />
<a href="<?php echo site_url('product'); ?>?p=p7" class="color-blue">Liquid Diamond</a> Paint Polish is recommended</p></div>

<div class="relative_image" id="exBW" style="background-color:#10243f;width:650px;height:300px;margin-left:-325px;margin-top:-175px">
				<h2>BRIGHT WORK<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
		<p>A metal cleaner/sealer is used to bring out the shine from oxidized metal.
Mirror Image is recommended</p>

<p><strong>BRIGHT WORK REJUVENATION:</strong> A two-step process resulting in a mirror finish on spinners, leading edges, engine
intakes and engine cones.</p>
<p>1) Oxidation is removed with a polish compound<br />
<a href="<?php echo site_url('product'); ?>?p=p9" class="color-blue">Skai Metal Polish</a> is recommended</p>
<p>2) A swirl remover is worked over the polished metal surface leaving the metal with a sealed mirror finish.
	<br /><a href="<?php echo site_url('product'); ?>?p=p8" class="color-blue">Mirroe Image</a> is recommended</p>		
</div>

   <div class="relative_image" id="exDI" style="background-color:#10243f;width:600px;height:325px;margin-left:-300px;margin-top:-150px">
				<h2>DE-ICE BOOTS<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
		
<p>A rubber boot sealant is applied.<br /><a href="<?php echo site_url('product'); ?>?p=p13" class="color-blue">PBS Boot Sealant</a> is recommended.</p>

<p><strong>DE-ICE BOOT REJUVENATION:</strong> A two step process resulting in super slick high glossed de-ice boots.</p>
<p>1) Any old product is removed from the De-Ice Boots.<br /><a href="<?php echo site_url('product'); ?>?p=p12" class="color-blue">PBS Boot Prep</a> is recommended</p>
<p>2) Multiple coats of rubber boot sealant are applied. The end result is a super slick ultra high gloss surface.<br /><a href="<?php echo site_url('product'); ?>?p=p13" class="color-blue">PBS Boot Sealant</a> is recommended</p>

</div>

<div class="relative_image" id="exLG" style="background-color:#10243f;width:400px;height:200px;margin-left:-200px;margin-top:-125px">
	<h2>LANDING GEAR<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
<p>A degreaser is applied, agitated and rinsed off.<br /><a href="<?php echo site_url('product'); ?>?p=p15" class="color-blue">BioJet</a> is recommended</p>
</div>


<div class="relative_image" id="inCR" style="background-color:#10243f;width:700px;height:275px;margin-left:-350px;margin-top:-145px">
	<h2>CARPET<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
<p><strong>CARPET UPKEEP:</strong> Carpet is thourouly vacuumed<br />
<strong>CARPET REJUVENATION:</strong> A dry foam carpet extraction method is used. The result is a "dry cleaned"
spotless carpet.<br />

1) Carpet is vacuumed clean.<br />
2) Carpet is then spot treated on any heavily soiled areas.<br />
<a href="<?php echo site_url('product'); ?>?p=p24" class="color-blue">Aircraft Carpet and upholstery stain remover</a> is recommended<br />
3) A dry foam carpet shampoo is used. Carpet is hand scrubbed to lift dirt from deep in the carpet pores.<br />
<span class="color-blue">Carpet Dry</span> Foam Detergent is recommended<br />
4) A final vacuuming is done. The result is completely DRY, like-new carpet.<br /></p>
<div class="space_20"></div></div>


<div class="relative_image" id="inUP" style="background-color:#10243f;width:500px;height:200px;margin-left:-250px;margin-top:-145px">
	<h2>UPHOLSTERY<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
<p><strong>LEATHER:</strong> A multi-purpose leather cleaner/conditioner is used on all leather surfaces.
<br /><a href="<?php echo site_url('product'); ?>?p=p25" class="color-blue">Aircraft Leather cleaner and conditioner</a> is Recommended</p>

<div class="space_20"></div>
</div>

<div class="relative_image" id="inTR" style="background-color:#10243f;width:500px;height:200px;margin-left:-250px;margin-top:-145px">
	<h2>TRIM/CABINETRY<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
	<p><strong>CABINETRY:</strong> Cabinet exteriors are wiped clean of fingerprints and smudges.
	<a href="<?php echo site_url('product'); ?>?p=p26" class="color-blue">Maguire's Ultimate Protectant Image</a> is recommended</p>
	<div class="space_20"></div>
</div>




<div class="relative_image" id="inWN" style="background-color:#10243f;width:500px;height:200px;margin-left:-250px;margin-top:-145px">
	<h2>WINDOWS<span class="right"><img src="/skin/pic/icon/close.png" height="16px" class="cit"></span></h2>
	<p><strong>WINDSCREEN:</strong> Aviation grade cleaners and rags are used on all glass and Plexiglas surfaces: Windows,
gauges, glass panels, flight management systems etc.<br />
<a href="<?php echo site_url('product'); ?>?p=p27" class="color-blue">Plexi-Clear</a> and <a href="<?php echo site_url('product'); ?>?p=p30" class="color-blue">Microfiber Clothes</a> are recommended</p>
</div>

<script type="text/javascript">
				
				$(document).ready(function(){
					$( ".spinner" ).spinner({ 
						spin: function( event, ui ) {
							SpinnerCalculate();
						},
						step: 0.01
					});
					
					$( ".spinner2" ).spinner({ 
						spin: function( event, ui ) {
							SpinnerCalculate();
						},
						step: 0.1
					});
					
					$( ".spinner1" ).spinner({ 
						spin: function( event, ui ) {
							SpinnerCalculate();
						},
						step: 1
					});
					
					$(".ui-spinner-button").click(function(){
						SpinnerCalculate();
					});

					
					$("#fuelBurn").val('<?php echo number_format($int_ext['model']->fuel_burn,1); ?>');
		  			$("#priceFuel").val('<?php echo number_format($int_ext['model']->fuel_price,2); ?>');
		  			$("#priceOil").val('<?php echo number_format($int_ext['model']->oil_burn,2); ?>');
		  			$("#airportExpense").val('<?php echo number_format($int_ext['model']->airport_expense,2); ?>');
		  			$("#noPiolet").val('<?php echo $int_ext['model']->piolet_count; ?>');
		  			SpinnerCalculate();
		  			
					/*$arCarpet = $("#carpetExtra").val().split("::");
					$arLeather = $("#leatherExtra").val().split("::");
					$arCarbinetry = $("#carbinetryExtra").val().split("::");
					$arGlass = $("#glassExtra").val().split("::");
					
					$("#inCarpet").attr("rel","");
					$("#inLeather").attr("rel","");
					$("#inCabinetry").attr("rel","");
					$("#inGlass").attr("rel","");

					$("#inCarpet").change(function(){
						$old = $(this).attr('rel');
						$(this).attr('rel',$(this).val());
						fillSpinnerData($(this).val(),$arCarpet,$old);
		  			});
		  			
		  			
		  			
		  			$("#inLeather").change(function(){
		  				$old = $(this).attr('rel');
						$(this).attr('rel',$(this).val());
						fillSpinnerData($(this).val(),$arLeather,$old);
		  			});
		  			
		  			$("#inCabinetry").click(function(){
		  				if($(this).prop('checked') == true){
			  				fillSpinnerData(1,$arCarbinetry,0);		  					
		  				}else{
			  				fillSpinnerData(0,$arCarbinetry,1);		  						  					
		  				}
		  			});
		  			
		  			$("#inGlass").click(function(){
		  				if($(this).prop('checked') == true){
			  				fillSpinnerData(1,$arGlass,0);		  					
		  				}else{
			  				fillSpinnerData(0,$arGlass,1);		  						  					
		  				}
		  			});
		  			*/
		  			
		  			
		  			
		  			
		  			/*$("#inLeather").change(function(){
		  				if($(this).val() != ""){
		  					$("#fuelBurn").val(parseInt($("#fuelBurn").val()) + parseInt($arLeather[0]));
				  			$("#priceFuel").val(parseInt($("#priceFuel").val()) + parseInt($arLeather[1]));
				  			$("#priceOil").val(parseInt($("#priceOil").val()) + parseInt($arLeather[2]));
				  			$("#airportExpense").val(parseInt($("#airportExpense").val()) + parseInt($arLeather[3]));
				  			$("#noPiolet").val(parseInt($("#noPiolet").val()) + parseInt($arLeather[4]));
		  				}else{
		  					$("#fuelBurn").val(parseInt($("#fuelBurn").val()) - parseInt($arLeather[0]));
				  			$("#priceFuel").val(parseInt($("#priceFuel").val()) - parseInt($arLeather[1]));
				  			$("#priceOil").val(parseInt($("#priceOil").val()) - parseInt($arLeather[2]));
				  			$("#airportExpense").val(parseInt($("#airportExpense").val()) - parseInt($arLeather[3]));
				  			$("#noPiolet").val(parseInt($("#noPiolet").val()) - parseInt($arLeather[4]));
		  				}
		  			});
		  			
		  			$("#inCabinetry").change(function(){
		  				if($(this).val() != ""){
		  					$("#fuelBurn").val(parseInt($("#fuelBurn").val()) + parseInt($arCarbinetry[0]));
				  			$("#priceFuel").val(parseInt($("#priceFuel").val()) + parseInt($arCarbinetry[1]));
				  			$("#priceOil").val(parseInt($("#priceOil").val()) + parseInt($arCarbinetry[2]));
				  			$("#airportExpense").val(parseInt($("#airportExpense").val()) + parseInt($arCarbinetry[3]));
				  			$("#noPiolet").val(parseInt($("#noPiolet").val()) + parseInt($arCarbinetry[4]));
		  				}else{
		  					$("#fuelBurn").val(parseInt($("#fuelBurn").val()) - parseInt($arCarbinetry[0]));
				  			$("#priceFuel").val(parseInt($("#priceFuel").val()) - parseInt($arCarbinetry[1]));
				  			$("#priceOil").val(parseInt($("#priceOil").val()) - parseInt($arCarbinetry[2]));
				  			$("#airportExpense").val(parseInt($("#airportExpense").val()) - parseInt($arCarbinetry[3]));
				  			$("#noPiolet").val(parseInt($("#noPiolet").val()) - parseInt($arCarbinetry[4]));
		  				}
		  			});
		  			
		  			$("#inGlass").change(function(){
		  				if($(this).val() != ""){
		  					$("#fuelBurn").val(parseInt($("#fuelBurn").val()) + parseInt($arGlass[0]));
				  			$("#priceFuel").val(parseInt($("#priceFuel").val()) + parseInt($arGlass[1]));
				  			$("#priceOil").val(parseInt($("#priceOil").val()) + parseInt($arGlass[2]));
				  			$("#airportExpense").val(parseInt($("#airportExpense").val()) + parseInt($arGlass[3]));
				  			$("#noPiolet").val(parseInt($("#noPiolet").val()) + parseInt($arGlass[4]));
		  				}else{
		  					$("#fuelBurn").val(parseInt($("#fuelBurn").val()) - parseInt($arGlass[0]));
				  			$("#priceFuel").val(parseInt($("#priceFuel").val()) - parseInt($arGlass[1]));
				  			$("#priceOil").val(parseInt($("#priceOil").val()) - parseInt($arGlass[2]));
				  			$("#airportExpense").val(parseInt($("#airportExpense").val()) - parseInt($arGlass[3]));
				  			$("#noPiolet").val(parseInt($("#noPiolet").val()) - parseInt($arGlass[4]));
		  				}
		  			});*/
				
				});
				
				function fillSpinnerData($value,$arMain,$old){
					if($value != "" && $old == ""){
		  				$("#fuelBurn").val(parseFloat($("#fuelBurn").val()) + parseFloat($arMain[0]));
				  		$("#priceFuel").val(parseFloat($("#priceFuel").val()) + parseFloat($arMain[1]));
				  		$("#priceOil").val(parseFloat($("#priceOil").val()) + parseFloat($arMain[2]));
				  		$("#airportExpense").val(parseFloat($("#airportExpense").val()) + parseFloat($arMain[3]));
				  		$("#noPiolet").val(parseInt($("#noPiolet").val()) + parseInt($arMain[4]));
		  			}else if($value == "" && $old != ""){
		  				$("#fuelBurn").val(parseFloat($("#fuelBurn").val()) - parseFloat($arMain[0]));
				  		$("#priceFuel").val(parseFloat($("#priceFuel").val()) - parseFloat($arMain[1]));
				  		$("#priceOil").val(parseFloat($("#priceOil").val()) - parseFloat($arMain[2]));
				  		$("#airportExpense").val(parseFloat($("#airportExpense").val()) - parseFloat($arMain[3]));
				  		$("#noPiolet").val(parseInt($("#noPiolet").val()) - parseInt($arMain[4]));
		  			}
		  			SpinnerCalculate();
				}
				
				function SpinnerCalculate(){
					$j = parseFloat($("#fuelBurn").val());
					$k = parseFloat($("#priceFuel").val());
					$l = parseFloat($("#priceOil").val());
					$m = parseFloat($("#airportExpense").val());
					$nz = parseFloat($("#noPiolet").val());
					
					$res = ((( $j * $k ) + $l + $m) / $nz);
					$("#soExp").html('$' + $res.toFixed(2));
					$("#sharedExpense").val($res.toFixed(2));
				}
			</script>