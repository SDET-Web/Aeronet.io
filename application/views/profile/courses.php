<div class="vd_content-section clearfix">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h1>Available Courses</h1>
                    <div class="clearfix pt-20">&nbsp;</div>
                    <div class="row">
                        <div class="col-lg-12 col-md-9">
                            <div class="panel widget light-widget">
                                <div class="panel-body">
                                    <div class="row mgbt-xs-0">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="content-list content-image content-chat">
                                                <table style="width:100%;">
                                                    <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>TITLE</th>
                                                        <th>COST</th>
                                                        <th>PRESENTED BY</th>
                                                        <th>CREDIT</th>
                                                        <th>ACTION</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    foreach($data as $course): ?>
                                                            <tr>
                                                                <td><?php echo $course['num']; ?></td>
                                                                <td><?php echo $course['title']; ?></td>
                                                                <td><?php echo $course['cost']; ?></td>
                                                                <td><?php echo $course['presenter']; ?></td>
                                                                <td><?php echo $course['credit']; ?></td>
                                                                <td><a href="https://www.faasafety.gov<?php echo $course['url']; ?>">ENROLL</a></td>
                                                            </tr>
                                                            <?php
                                                    endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br/><br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<style>


    th {
        color:#D5DDE5;;
        background:#1b1e24;
        border-bottom:4px solid #9ea7af;
        border-right: 1px solid #343a45;
        font-size:23px;
        font-weight: 100;
        padding:24px;
        text-align:left;
        text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
        vertical-align:middle;
    }

    th:first-child {
        border-top-left-radius:3px;
    }

    th:last-child {
        border-top-right-radius:3px;
        border-right:none;
    }

    tr {
        border-top: 1px solid #C1C3D1;
        border-bottom-: 1px solid #C1C3D1;
        color:#666B85;
        font-size:16px;
        font-weight:normal;
        text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
    }

    tr:hover td {
        background:#4E5066;
        color:#FFFFFF;
        border-top: 1px solid #22262e;
        border-bottom: 1px solid #22262e;
    }

    tr:first-child {
        border-top:none;
    }

    tr:last-child {
        border-bottom:none;
    }

    tr td:first-child{
        border-left:1px solid #C1C3D1;
    }

    td {
        background:#FFFFFF;
        padding:20px;
        text-align:left;
        vertical-align:middle;
        font-weight:300;
        font-size:18px;
        text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
        border-right: 1px solid #C1C3D1;
    }

    th.text-left {
        text-align: left;
    }

    th.text-center {
        text-align: center;
    }

    th.text-right {
        text-align: right;
    }

    td.text-left {
        text-align: left;
    }

    td.text-center {
        text-align: center;
    }

    td.text-right {
        text-align: right;
    }

    @media screen and (max-width: 600px) {
        table {width:100%;}
        thead {display: none;}
        tr:nth-of-type(2n) {background-color: inherit;}
        tr td:first-child {background: #f0f0f0; font-weight:bold;font-size:1.3em;}
        tr td{border-left:1px solid #C1C3D1;}
        tr td:last-child{border-right:1px solid #C1C3D1;}
        tbody td {display: block;  text-align:center;}
        tbody td:before {
            content: attr(data-th);
            display: block;
            text-align:center;
        }
    }

</style>
