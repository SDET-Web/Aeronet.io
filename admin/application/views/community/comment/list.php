<thead>
<tr>
    <th>User</th>
    <th>Post Type</th>
    <th>Comment</th>
    <th>Created</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php if($records->num_rows() > 0){ ?>
    <?php foreach($records->result() as $record){ ?>
        <tr>
            <td><?php echo $record->user_fname.' '.$record->user_lname; ?></td>
            <td><?php echo select_post_type($record->post_type); ?></td>
            <td><?php echo $record->comm_text; ?></td>
            <td><?php echo date('m/d/Y h:i',$record->comm_created); ?></td>
            <td class="text-center">
                <a class="delete btn btn-sm btn-danger" href="?delete=<?php echo $record->comm_id; ?>"><i class="icons-office-52"></i></a>
            </td>
        </tr>
    <?php } ?>
<?php }else{ ?>
    <tr>
        <td colspan="8"><?php echo RIZ_MSG; ?></td>
    </tr>
<?php } ?>
</tbody>