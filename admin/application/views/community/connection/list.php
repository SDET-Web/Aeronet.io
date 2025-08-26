<thead>
<tr>
    <th>User</th>
    <th>Connection</th>
    <th>Status</th>
    <th>Type</th>
    <th>Created</th>
</tr>
</thead>
<tbody>
<?php if($records->num_rows() > 0){ ?>
    <?php foreach($records->result() as $record){ ?>
        <tr>
            <td><?php echo $record->username; ?></td>
            <td><?php echo $record->conn; ?></td>
            <td><?php echo select_conn_status($record->conn_status); ?></td>
            <td><?php echo select_conn_type($record->conn_type); ?></td>
            <td><?php echo date('m/d/Y',$record->conn_created); ?></td>
        </tr>
    <?php } ?>
<?php }else{ ?>
    <tr>
        <td colspan="8"><?php echo RIZ_MSG; ?></td>
    </tr>
<?php } ?>
</tbody>