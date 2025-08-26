<!--<div><center><h1>Cover Letter</h1></center></div><br>
<div>
    <?php //form_new_textarea_updated('', 'coverLetter', "" , false, 3, 'hidden', ''); ?>
    <div id="cover_letter">
        <?php //echo isset($addendum->cover_letter) ? $addendum->cover_letter : ""; ?>
    </div>
</div>-->
 <h3>Addendum Questionnaire</h3><br>
<div>
    <p>Have you ever applied with our organization in the past?</p>
    <input type="radio" name="organization" value="yes" <?php if(isset($addendum->organization) && $addendum->organization == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="organization" value="no" <?php if(isset($addendum->organization) && $addendum->organization == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>When?</p>
    <input type="text" name="organization_detail" id="" value="<?php echo isset($addendum->organization_detail) ? $addendum->organization_detail : ""; ?>"/>
</div>
<div>
    <p>Have you ever interviewed with our organization in the past?</p>
    <input type="radio" name="interviewed" value="yes" <?php if(isset($addendum->interviewed) && $addendum->interviewed == 'yes'){ echo 'checked'; } ?> > Yes<br>
    <input type="radio" name="interviewed" value="no" <?php if(isset($addendum->interviewed) && $addendum->interviewed == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>When?</p>
    <input type="text" name="interviewed_detail" id="" value="<?php echo isset($addendum->interviewed_detail) ? $addendum->interviewed_detail : ""; ?>"/>
</div>
<div>
    <p>Have you ever been employed within our organization in the past?</p>
    <input type="radio" name="employed" value="yes" <?php if(isset($addendum->employed) && $addendum->employed == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="employed" value="no" <?php if(isset($addendum->employed) && $addendum->employed == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>When?</p>
    <input type="text" name="employed_detail" id="" value="<?php echo isset($addendum->employed_detail) ? $addendum->employed_detail : ""; ?>"/>
    <p>What Position?</p>
    <input type="text" name="employed_position" id="" value="<?php echo isset($addendum->employed_position) ? $addendum->employed_position : ""; ?>"/>
</div>
<div>
    <p>Do you have an Internal Recommendation(s)?</p>
    <input type="radio" name="Recommendation" value="yes" <?php if(isset($addendum->recommendation) && $addendum->recommendation == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="Recommendation" value="no" <?php if(isset($addendum->recommendation) && $addendum->recommendation == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>enter employee's name(s)</p>
    <input type="text" name="Recommendation_detail" id="" value="<?php echo isset($addendum->recommendation_detail) ? $addendum->recommendation_detail : ""; ?>"/>
</div>
<div class="form-level">
    <h4>Criminal Background - Self Disclosure</h4>
    <p>The FAA requires all air carriers to complete a FBI criminal background check and fingerprinting on all prospective employees. The fingerprinting results will indicate any crime, whether it has been expunged, records have been sealed, or incident occurred when you were a minor.</p>
</div>
<div>
    <p>Have you ever had an arrest or conviction? (even if dismissed, expunged, or when you where a minor)</p>
    <input type="radio" name="arrested" value="yes" <?php if(isset($addendum->arrested) && $addendum->arrested == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="arrested" value="no" <?php if(isset($addendum->arrested) && $addendum->arrested == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>provide date?</p>
    <input type="date" name="arrested_date" id="" value="<?php echo isset($addendum->arrested_date) ? $addendum->arrested_date : ""; ?>"/>
    <p>charge?</p>
    <input type="text" name="arrested_charge" id="" value="<?php echo isset($addendum->arrested_charge) ? $addendum->arrested_charge : ""; ?>"/>
    <p>disposition?</p>
    <input type="text" name="arrested_disposition" id="" value="<?php echo isset($addendum->arrested_disposition) ? $addendum->arrested_disposition : ""; ?>"/>
</div>
<div class="form-level">
    <h4>NOTE:</h4>
    <p>A conviction does not automatically mean that you will not be offered a job. The crime of which you were convicted, circumstances surrounding the conviction, and how long ago the conviction occurred are important. Please provide complete information so  an informed decision can be made.</p>
</div>
<div class="form-level">
    <h4>Department of Transportation - Self Disclosure:</h4>
    <p>The Department of Transportation (DOT) regulations requires pre-employment drug test, for safety-sensitive positions, which screens for marijuana, cocaine, phencyclamine (PCP), opiates and amphetamines or their metabolites.</p>
</div>
<div>
    <p>Have you held a safety sensitive job function subject to Department of Transportation drug and/or alcohol rules in the past five (5) years?</p>
    <input type="radio" name="job_function" value="yes" <?php if(isset($addendum->job_function) && $addendum->job_function == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="job_function" value="no" <?php if(isset($addendum->job_function) && $addendum->job_function == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div>
    <p>Have you tested positive on or refused a Department of Transportation drug test in the past five (5) years?</p>
    <input type="radio" name="drug_test" value="yes" <?php if(isset($addendum->drug_test) && $addendum->drug_test == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="drug_test" value="no" <?php if(isset($addendum->drug_test) && $addendum->drug_test == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div>
    <p>Have you tested positive and/or refused a Department of Transportation alcohol test in the past five (5) years?</p>
    <input type="radio" name="alcohol_test" value="yes" <?php if(isset($addendum->alcohol_test) && $addendum->alcohol_test == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="alcohol_test" value="no" <?php if(isset($addendum->alcohol_test) && $addendum->alcohol_test == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div>
    <p>During the last two (2) years, have you tested positive or refused to test on any pre-employment drug or alcohol test administered by a Department of Transportation employer for a safety-sensitive position for which you applied but were not hired?</p>
    <input type="radio" name="pre_employment_test" value="yes" <?php if(isset($addendum->pre_employment_test) && $addendum->pre_employment_test == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="pre_employment_test" value="no" <?php if(isset($addendum->pre_employment_test) && $addendum->pre_employment_test == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div>
    <p>Have you ever been Permanently Barred from the performance of safety-sensitive job functions by an employer under Federal Aviation Administration (FAA) drug/alcohol regulations?</p>
    <input type="radio" name="barred" value="yes" <?php if(isset($addendum->barred) && $addendum->barred == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="barred" value="no" <?php if(isset($addendum->barred) && $addendum->barred == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <h4>Driving History - Self Disclosure:</h4>
</div>
<div>
    <p>Has your driver’s license ever been suspended?</p>
    <input type="radio" name="license" value="yes" <?php if(isset($addendum->license) && $addendum->license == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="license" value="no" <?php if(isset($addendum->license) && $addendum->license == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>Please explain Including the nature:</p>
    <input type="text" name="license_explain" id="" value="<?php echo isset($addendum->license_explain) ? $addendum->license_explain : ""; ?>"/>
    <p>Date</p>
    <input type="date" name="license_date" id="" value="<?php echo isset($addendum->license_date) ? $addendum->license_date : ""; ?>"/>
    <p>County:</p>
    <input type="text" name="license_country" id="" value="<?php echo isset($addendum->license_country) ? $addendum->license_country : ""; ?>"/>
    <p>State:</p>
    <input type="text" name="license_state" id="" value="<?php echo isset($addendum->license_state) ? $addendum->license_state : ""; ?>"/>
</div>
<div>
    <p>Have you been fined, plead guilty to, been convicted of, or been placed on probation for any moving traffic violations? (examples of moving traffic violations are, but not limited to: speeding, turn on red, running a red light, failure to yield, driving on a suspended license, careless driving, reckless driving, DUI/DWI, impaired driving, etc.)*</p>
    <input type="radio" name="fined" value="yes" <?php if(isset($addendum->fined) && $addendum->fined == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="fined" value="no" <?php if(isset($addendum->fined) && $addendum->fined == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>Please explain:</p>
    <input type="text" name="fined_explain" id="" value="<?php echo isset($addendum->fined_explain) ? $addendum->fined_explain : ""; ?>"/>
    <p>Including the nature:</p>
    <input type="text" name="fined_nature" id="" value="<?php echo isset($addendum->fined_nature) ? $addendum->fined_nature : ""; ?>"/>
    <p>Date</p>
    <input type="date" name="fined_date" id="" value="<?php echo isset($addendum->fined_date) ? $addendum->fined_date : ""; ?>"/>
    <p>County:</p>
    <input type="text" name="fined_country" id="" value="<?php echo isset($addendum->fined_country) ? $addendum->fined_country : ""; ?>"/>
    <p>State of each violation:</p>
    <input type="text" name="fined_state" id="" value="<?php echo isset($addendum->fined_state) ? $addendum->fined_state : ""; ?>"/>
    <p>Any other pertinent information:</p>
    <input type="text" name="fined_extra" id="" value="<?php echo isset($addendum->fined_extra) ? $addendum->fined_extra : ""; ?>"/>
</div>
<div class="form-level">
    <h4>FAA Record and Training Events - Self Disclosure</h4>
</div>
<div>
    <p>Have you ever had, or been involved in, any aircraft accidents, incidents, or violations?</p>
    <input type="radio" name="involved" value="yes" <?php if(isset($addendum->involved) && $addendum->involved == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="involved" value="no" <?php if(isset($addendum->involved) && $addendum->involved == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>Please explain:</p>
    <input type="text" name="involved_explain" id="" value="<?php echo isset($addendum->involved_explain) ? $addendum->involved_explain : ""; ?>"/>
</div>
<div>
    <p>Have you ever been administered an FAA 709 checkride?</p>
    <input type="radio" name="administered" value="yes" <?php if(isset($addendum->administered) && $addendum->administered == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="administered" value="no" <?php if(isset($addendum->administered) && $addendum->administered == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>Please explain:</p>
    <input type="text" name="administered_explain" id="" value="<?php echo isset($addendum->administered_explain) ? $addendum->administered_explain : ""; ?>"/>
</div>
<div>
    <p>Have you ever failed to complete Initial, Transition, or an Upgrade course of training under FAR Part 121 or FAR Part 135?</p>
    <input type="radio" name="failed" value="yes" <?php if(isset($addendum->failed) && $addendum->failed == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="failed" value="no" <?php if(isset($addendum->failed) && $addendum->failed == 'no'){ echo 'checked'; } ?>> No<br>
</div>
<div class="form-level">
    <p>Please explain:</p>
    <input type="text" name="failed_explain" id="" value="<?php echo isset($addendum->failed_explain) ? $addendum->failed_explain : ""; ?>"/>
</div>
<div>
    <p>Have you ever failed a checkride? (include all initial, recurrent, upgrade, transition, proficiency, line checks, rating check rides, Part 141/142 stage/phase checks, any orals, and any military checkrides)</p>
    <input type="radio" name="checkride" value="yes" <?php if(isset($addendum->checkride) && $addendum->checkride == 'yes'){ echo 'checked'; } ?>> Yes<br>
    <input type="radio" name="checkride" value="no" <?php if(isset($addendum->checkride) && $addendum->checkride == 'no'){ echo 'checked'; } ?>> No<br><br>

    <div class="form-level">
    <p>Please explain:</p>
    <input type="text" name="license_nature" id="" value="<?php echo isset($addendum->license_nature) ? $addendum->license_nature : ""; ?>"/>
    </div>
</div>

<script type="text/javascript">
    var quill_description;
    var quill_requirement;
    page_init();
    function page_init(){
        console.log("form init called");
        quill_cover_letter = new Quill('#cover_letter', {
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    ['link', 'blockquote'],
                    [{list: 'ordered'}, {list: 'bullet'}]
                ]
            },
            placeholder: 'Enter your cover letter...',
            theme: 'snow'
        });
    }

    function set_form_fields() {
        //console.log("set form fields called");
        $('#coverLetter').val(JSON.stringify($('#cover_letter .ql-editor').html()));
        //$('#addendum_form').submit();
    }
</script>