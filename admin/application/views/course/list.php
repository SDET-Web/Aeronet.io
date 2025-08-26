<script>
    $(document).ready(function(){
        $("#model").change(function(){
            window.location = '?<?php //echo ($this->input->get('page')!=''?'page='.$this->input->get('page').'&':''); ?>model=' + $(this).val();
        });
    });
</script>
<thead>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Offered By</th>
    <th>Date</th>
    <th>Status</th>
    <th>Created</th>
    <th>Action</th>
</tr>
</thead>
<tbody>
<?php if($records->num_rows() > 0){ ?>
    <?php foreach($records->result() as $record){ ?>
        <tr>
            <td><?php echo $record->course_faa_id; ?></td>
            <td><?php echo $record->course_name; ?></td>
            <td><?php echo $record->course_offered_by; ?></td>
            <td><?php echo $record->course_date; ?></td>
            <td><?php echo select_course_status($record->course_status); ?></td>
            <td><?php echo date('m/d/Y',$record->course_created); ?></td>
           <td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->course_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->course_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td>
        </tr>
    <?php } ?>
<?php }else{ ?>
    <tr>
        <td colspan="8"><?php echo RIZ_MSG; ?></td>
    </tr>
<?php } ?>
</tbody>
