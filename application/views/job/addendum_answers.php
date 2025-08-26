
    <section id="feature" style="margin-top:-45px;" >
        <a name="post"></a>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-xs-12 col-md-offset-2" style="margin-top:-30px;">			
					<div><center><h1>Output Of Form</h1></center></div><br>
					<div>
						<p><b>Have you ever applied with our organization in the past?</b></p> 
						<p><?php echo $addendum->organization; ?></p>
					</div>
					<div class="form-level">
						<p><b>When?</b></p>
						<p><?php echo $addendum->organization_detail; ?></p>
					</div>
					<div>
						<p><b>Have you ever interviewed with our organization in the past?</b></p>                            
						<p><?php echo $addendum->interviewed; ?></p>
					</div>
					<div class="form-level">
						<p><b>When?</b></p>
						<p><?php echo $addendum->interviewed_detail; ?></p>
					</div>
					<div>
						<p><b>Have you ever been employed within our organization in the past?</b></p>                            
						<p><?php echo $addendum->employed; ?></p>
					</div>
					<div class="form-level">
						<p><b>When?</b></p>
						<p><?php echo $addendum->employed_detail; ?></p>
						<p><b>What Position?</b></p>
						<p><?php echo $addendum->employed_position; ?></p>
					</div>
					<div>
						<p><b>Do you have an Internal Recommendation(s)?</b></p>                            
						<p><?php echo $addendum->recommendation; ?></p>
					</div>
					<div class="form-level">
						<p><b>enter employee's name(s)</b></p>
						<p><?php echo $addendum->recommendation_detail; ?></p>
					</div>
					<div class="form-level">
						<h2>Criminal Background - Self Disclosure</h2>						
					</div>
					<div>
						<p><b>Have you ever had an arrest or conviction? (even if dismissed, expunged, or when you where a minor)</b></p>                            
						<p><?php echo $addendum->arrested; ?></p>
					</div>
					<div class="form-level">
						<p><b>provide date?</b></p>
						<p><?php echo $addendum->arrested_date; ?></p>
						<p><b>charge?</b></p>
						<p><?php echo $addendum->arrested_charge; ?></p>
						<p><b>disposition?</b></p>
						<p><?php echo $addendum->arrested_disposition; ?></p>
					</div>					
					<div class="form-level">
						<h2>Department of Transportation - Self Disclosure:</h2>						
					</div>
					<div>
						<p><b>Have you held a safety sensitive job function subject to Department of Transportation drug and/or alcohol rules in the past five (5) years?</b></p>                            
						<p><?php echo $addendum->job_function; ?></p>
					</div>
					<div>
						<p><b>Have you tested positive on or refused a Department of Transportation drug test in the past five (5) years?</b></p>                            
						<p><?php echo $addendum->drug_test; ?></p>
					</div>
					<div>
						<p><b>Have you tested positive and/or refused a Department of Transportation alcohol test in the past five (5) years?</b></p>                            
						<p><?php echo $addendum->alcohol_test; ?></p>
					</div>
					<div>
						<p><b>During the last two (2) years, have you tested positive or refused to test on any pre-employment drug or alcohol test administered by a Department of Transportation employer for a safety-sensitive position for which you applied but were not hired?</b></p>                            
						<p><?php echo $addendum->pre_employment_test; ?></p>
					</div>
					<div>
						<p><b>Have you ever been Permanently Barred from the performance of safety-sensitive job functions by an employer under Federal Aviation Administration (FAA) drug/alcohol regulations?</b></p>                            
						<p><?php echo $addendum->barred; ?></p>
					</div>
					<div class="form-level">
						<h2>Driving History - Self Disclosure:</h2>							
					</div>
					<div>
						<p><b>Has your driver’s license ever been suspended?</b></p>                            
						<p><?php echo $addendum->license; ?></p>
					</div>
					<div class="form-level">
						<p><b>Please explain:</b></p>
						<p><?php echo $addendum->license_explain; ?></p>
						<p><b>Including the nature:</b></p>
						<p><?php echo $addendum->license_nature; ?></p>
						<p><b>Date</b></p>
						<p><?php echo $addendum->license_date; ?></p>
						<p><b>County:</b></p>
						<p><?php echo $addendum->license_country; ?></p>
						<p><b>State:</b></p>
						<p><?php echo $addendum->license_state; ?></p>
					</div>
					<div>
						<p><b>Have you been fined, plead guilty to, been convicted of, or been placed on probation for any moving traffic violations? (examples of moving traffic violations are, but not limited to: speeding, turn on red, running a red light, failure to yield, driving on a suspended license, careless driving, reckless driving, DUI/DWI, impaired driving, etc.)</b></p>                            
						<p><?php echo $addendum->fined; ?></p>
					</div>
					<div class="form-level">
						<p><b>Please explain:</b></p>
						<p><?php echo $addendum->fined_explain; ?></p>
						<p><b>Including the nature:</b></p>
						<p><?php echo $addendum->fined_nature; ?></p>
						<p><b>Date</b></p>
						<p><?php echo $addendum->fined_date; ?></p>
						<p><b>County:</b></p>
						<p><?php echo $addendum->fined_country; ?></p>
						<p><b>State of each violation:</b></p>
						<p><?php echo $addendum->fined_state; ?></p>
						<p><b>Any other pertinent information:</b></p>
						<p><?php echo $addendum->fined_extra; ?></p>
					</div>
					<div class="form-level">
						<h2>FAA Record and Training Events - Self Disclosure</h2>							
					</div>
					<div>
						<p><b>Have you ever had, or been involved in, any aircraft accidents, incidents, or violations?</b></p>                            
						<p><?php echo $addendum->involved; ?></p>
					</div>
					<div class="form-level">
						<p><b>Please explain:</b></p>
						<p><?php echo $addendum->involved_explain; ?></p>
					</div>
					<div>
						<p><b>Have you ever been administered an FAA 709 checkride?</b></p>                            
						<p><?php echo $addendum->administered; ?></p>
					</div>
					<div class="form-level">
						<p><b>Please explain:</b></p>
						<p><?php echo $addendum->administered_explain; ?></p>
					</div>
					<div>
						<p><b>Have you ever failed to complete Initial, Transition, or an Upgrade course of training under FAR Part 121 or FAR Part 135?</b></p>                            
						<p><?php echo $addendum->failed; ?></p>
					</div>
					<div class="form-level">
						<p><b>Please explain:</b></p>
						<p><?php echo $addendum->failed_explain; ?></p>
					</div>
					<div>
						<p><b>Have you ever failed a checkride? (include all initial, recurrent, upgrade, transition, proficiency, line checks, rating check rides, Part 141/142 stage/phase checks, any orals, and any military checkrides)</b></p>                            
						<p><?php echo $addendum->checkride; ?></p>
					</div>				
						
				</div>
				
			</div>
		</div>
        
    </section>