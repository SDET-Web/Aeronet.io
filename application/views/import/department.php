<style type="text/css">
    .subjectrow.mailing-row{display:none;}
    .messagerow.mailing-row{display:none;}
    table.contacts {
        border-collapse: collapse;
        width: 100%;
    }

    table.contacts th, table.contacts td {
        text-align: left;
        padding: 8px;
    }

    table.contacts tr:nth-child(even){background-color: #f2f2f2}

    table.contacts th {
        background-color: #242729;
        color: white;
    }
</style>
<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-sm-3">
            <?php $this->load->view('profile/sidebar/pilot',array('data'=>$data)); ?>
            <!-- panel widget -->

            <div class="panel widget light-widget">
                <div class="panel-body-list">
                    <h3 class="pd-20 mgbt-xs-0"><i class="fa fa-users mgr-10"></i>Pilot Pool</h3>
                    <div class="content-grid column-xs-2 column-sm-3 height-xs-auto mgbt-xs-20">
                        <div>
                            <ul class="list-wrapper">
                                <?php if(count($data['pool'])): ?>
                                    <?php for($i = 0; $i < (count($data['pool']) > 9?9:count($data['pool']));$i++): $item = (array)$data['pool'][$i]; ?>
                                        <li> <a href="<?php echo site_url('pilot/'.$item['user_id']); ?>"> <span class="menu-icon"><img alt="example image" src="<?php echo get_user_pic_url($item['user_image']); ?>"></span> </a> </li>
                                    <?php endfor;?>
                                <?php else: ?>
                                    <p class="text-center">No connection found</p>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <?php if(count($data['connections']) > 9): ?>
                        <div class="closing text-center" style=""> <a href="#">See All Friends<i class="fa fa-angle-double-right prepend-icon"></i></a> </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- panel widget -->

            <!-- panel widget -->

            <div class="panel widget light-widget">
                <div class="panel-body-list">
                    <h3 class="pd-10 mgbt-xs-0">Jobs Board</h3>
                    <div class="content-grid column-xs-2 column-sm-3 height-xs-auto mgbt-xs-20">
                        <div>
                            <a href="#">  <img src="<?php echo RIZ_ASSETS_BACKEND; ?>img/flight.jpg" class="img-responsive"></a>
                        </div>
                    </div>
                    <div class="closing text-center" style=""> <a href="<?php echo site_url('flight-dispatch-board'); ?>">See All Listings<i class="fa fa-angle-double-right prepend-icon"></i></a> </div>
                </div>
            </div>
            <!-- panel widget -->


        </div>
        <div class="col-sm-9">
            <div class="row">
                <div class="col-lg-8 col-md-9">
                    <div id="home-tab" class="tab-pane active">
                        <div class="panel widget light-widget">
                            <div class="panel-body">
                                <div class="row mgbt-xs-0">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="content-list content-image content-chat">
                                            <h1>Grow your network</h1>
                                            <br />
                                            <input type="hidden" id="addressbook" value=""/>
                                            <input type="hidden" id="selectedcontacts" value=""/>
                                            <input type="hidden" id="subject" value=""/>
                                            <input type="hidden" id="message" value=""/>



                                            <!-- CONTACT IMPORTER CODE -->
                                            <div class="socialinviter" type="contactimporter"></div>
                                            <!-- /CONTACT IMPORTER CODE -->


                                            <!-- Place the below script at the end of the file -->
                                            <script type="text/javascript">
                                                var storeImportedContacts = function (data) {
                                                    var len = data.length;
                                                    var contacts = "";
                                                    for (var i = 0; i < len; i++) {
                                                        if (i != 0) {
                                                            contacts += ", "
                                                        }
                                                        contacts += data[i].name.first_name + " " + data[i].name.last_name;
                                                        contacts += "< " + data[i].email[0] + " > ";
                                                    }
                                                    var postdata =  {action: "contacts",data:JSON.stringify(data)};
                                                    $.post("<?php echo site_url('import/contacts/'.$this->session->userdata('user_id')); ?>", postdata, function (response) {
                                                        console.log(response);
                                                    });
                                                }
                                                var storeSelectedContacts = function () {
                                                    var contacts = "";
                                                    var data = socialinviter.contactimporter.getSelectedContacts().addressbook;
                                                    var len = data.length;
                                                    for (var i = 0; i < len; i++) {
                                                        if (i != 0) {
                                                            contacts += ", "
                                                        }
                                                        contacts += data[i].name.first_name + " " + data[i].name.last_name;
                                                        contacts += "< " + data[i].email[0] + " > ";
                                                    }
                                                    var postdata =  {action: "selectedcontacts",data:JSON.stringify(socialinviter.contactimporter.getSelectedContacts().addressbook)};
                                                    $.post("<?php echo site_url('import/contacts/'.$this->session->userdata('user_id')); ?>", postdata, function (response) {
                                                        console.log(response);
                                                    });
                                                }
                                                var sendSelectedContacts = function () {
                                                    var data =  {
                                                        action: "selectedcontacts",
                                                        data:JSON.stringify(socialinviter.contactimporter.getRecipients()),
                                                        subject:$(".mailing-subject").val(),
                                                        message: $(".mailing-message").val()
                                                    };
                                                    $.post("<?php echo site_url('import/contacts/'.$this->session->userdata('user_id')); ?>", data, function (response) {
                                                        //console.log(response);
                                                        socialinviter.modalSI.showSuccessMessage("Success: Email sent.");
                                                        //socialinviter.modalSI.showInfoMessage("Note: Please use your SMTP to send emails");
                                                        window.location.reload(true);
                                                    });
                                                }

                                            </script>

                                            <script type="text/javascript">
                                                var licenses = "<?php echo RIZ_SI_KEY ?>";
                                                var authpageUrl = "<?php echo RIZ_HOST.site_url(RIZ_AUTH_PAGE); ?>/";
                                                var SIConfiguration = {
                                                    "path": {
                                                        "authpage": authpageUrl
                                                    },
                                                    "callbacks": {
                                                        "loaded": function (service, data) {
                                                            storeImportedContacts(data);
                                                        },
                                                        "send": function (event, service, recipients, response) {
                                                            sendSelectedContacts();
                                                        },
                                                        "proceed": function (event, service) {
                                                            storeSelectedContacts();
                                                        }
                                                    }
                                                }

                                                /* Initialize the plugin */
                                                var fileref=document.createElement("script");fileref.setAttribute("type","text/javascript");fileref.setAttribute("id","apiscript");fileref.setAttribute("src","//socialinviter.com/all.js?keys="+licenses);
                                                try{document.body.appendChild(fileref)}catch(a){document.getElementsByTagName("head")[0].appendChild(fileref);}var loadInitFlg=0,socialinviter,loadConf=function(){window.setTimeout(function(){$(document).ready(function(){loadInitFlg++;
                                                    socialinviter?socialinviter.load(SIConfiguration):15>loadInitFlg&&window.setTimeout(loadConf,200)})},250)};window.setTimeout(loadConf,200);
                                            </script>
                                            <br />
                                            <div class="clearfix"></div>
                                            <div class="row" style="padding:20px 0">
                                                <div class="col-sm-12">
                                                    <form method="post">
                                                        <input type="hidden" name="action" value="send_invitation" />
                                                        <div class="content-list content-image content-chat">
                                                            <h1 style="float:left">Imported Contacts</h1>
                                                            <button type="submit" class="btn vd_btn vd_bg-grey mgr-10" style="float:right;"><i class="fa fa-envelope append-icon"></i>Send Invitations</button>
                                                            <div class="clearfix"></div>
                                                            <table class="contacts">
                                                                <thead>
                                                                <tr>
                                                                    <th><input type="checkbox" class="select_all" /></th>
                                                                    <th>Email</th>
                                                                    <th>Name</th>
                                                                    <th>Status</th>
                                                                </tr>
                                                                </thead>
                                                                <?php if(count($contacts) > 0): ?>
                                                                    <?php foreach($contacts as $user): ?>
                                                                        <tr>
                                                                            <td><input name="selected[]" value="<?php echo get_data_value($user,'contact_id'); ?>" class="select_check" type="checkbox" /></td>
                                                                            <td><?php echo get_data_value($user,'contact_email').' '.(get_data_value($user,'user_id')>0?'<b>(Registered)</b>':''); ?></td>
                                                                            <td><?php echo ucwords(strtolower(get_data_value($user,'contact_fname'))); ?> <?php echo ucwords(strtolower(get_data_value($user,'contact_lname'))); ?></td>
                                                                            <td><?php echo get_data_value($user,'contact_selected') == 'y'?'Sent':'Not Sent'; ?></td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                <?php else: ?>
                                                                    <tr><td colspan="3">No Contacts Imported.</td></tr>
                                                                <?php endif; ?>
                                                            </table>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- col-md-x -->
                <div class="col-lg-4 col-md-3">
                    <div class="panel widget light-widget">
                        <?php $this->load->view('people_panel',array('dept'=>'test')); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>