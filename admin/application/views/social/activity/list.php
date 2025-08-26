<script>
    $(document).ready(function(){
        $("#model").change(function(){
            window.location = '?<?php //echo ($this->input->get('page')!=''?'page='.$this->input->get('page').'&':''); ?>model=' + $(this).val();
        });
    });
</script>
<thead>
<tr>
    <th>Activity</th>
    <th width="10%">Created</th>
</tr>
</thead>
<tbody>
<?php if($records->num_rows() > 0){ ?>
    <?php foreach($records->result() as $record){ ?>
        <tr>
            <td><?php echo $record->user_fname.' '.$record->user_lname.' '.$record->activ_text.' '.$record->activ_entity.' with id '.$record->activ_entity_id; ?></td>
            <td><?php echo $record->activ_created; ?></td>
        </tr>
    <?php } ?>
<?php }else{ ?>
    <tr>
        <td colspan="8"><?php echo RIZ_MSG; ?></td>
    </tr>
<?php } ?>
</tbody>
