
    <section id="feature" style="margin-top:-45px;" >
        <a name="post"></a>
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-xs-12 col-md-offset-2" style="margin-top:-30px;">
                    <form name="addendum_form" id="addendum_form" method="post" action="<?php echo site_url((is_logged_in()?'job/apply_job/':'job/board')) ?>">

                        <?php $this->load->view('job/questions'); ?>

                            <button class="button-main2" type="button" onclick="set_form_fields()">Submit</button>
                            <!-- <button class="button-main2"> Post</button> -->
                            &nbsp;
                            <button type="button" class="button-main2" style="background:#333"
                                    onclick="window.location.replace('flight-dispatch-board');"> Back
                            </button>
                        </div>
                        <br/><br/>
                    </form>
                </div>
            </div>
        </div>
    </section>

