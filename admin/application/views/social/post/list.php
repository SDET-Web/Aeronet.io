<script>
    $(document).ready(function(){
        $("#model").change(function(){
            window.location = '?<?php //echo ($this->input->get('page')!=''?'page='.$this->input->get('page').'&':''); ?>model=' + $(this).val();
        });
    });
</script>
<thead>
<tr>
    <th>Type</th>
    <th>User</th>
    <th width="60%">Content</th>
    <th>Likes</th>
    <th>Created</th>
</tr>
</thead>
<tbody>
<?php if($records->num_rows() > 0){ ?>
    <?php foreach($records->result() as $record){ ?>
        <tr>
            <td><?php echo select_post_type($record->post_type); ?></td>
            <td><?php echo $record->user_fname.' '.$record->user_lname; ?></td>
            <td><?php echo $record->post_content; ?></td>
            <td><?php echo $record->post_like; ?></td>
            <td><?php echo date('m/d/Y h:i',$record->post_created); ?></td>
        </tr>
    <?php } ?>
<?php }else{ ?>
    <tr>
        <td colspan="8"><?php echo RIZ_MSG; ?></td>
    </tr>
<?php } ?>
</tbody>
