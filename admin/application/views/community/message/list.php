<thead>
<tr>
    <th>Sender</th>
    <th>Receiver</th>
    <th>Message</th>
    <th>Status</th>
    <th>Sent</th>
</tr>
</thead>
<tbody>
<?php if($records->num_rows() > 0){ ?>
    <?php foreach($records->result() as $record){ ?>
        <tr>
            <td><?php echo $record->username; ?></td>
            <td><?php echo $record->conn; ?></td>
            <td><?php echo $record->mess_text; ?></td>
            <td><?php echo select_mess_status($record->mess_status); ?></td>
            <td><?php echo date('m/d/Y h:i',$record->mess_created); ?></td>
        </tr>
    <?php } ?>
<?php }else{ ?>
    <tr>
        <td colspan="8"><?php echo RIZ_MSG; ?></td>
    </tr>
<?php } ?>
</tbody>