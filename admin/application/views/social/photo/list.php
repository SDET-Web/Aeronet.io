<script>
    $(document).ready(function(){
        $("#model").change(function(){
            window.location = '?<?php //echo ($this->input->get('page')!=''?'page='.$this->input->get('page').'&':''); ?>model=' + $(this).val();
        });
    });
</script>
<thead>
<tr>
    <th>Photo</th>
    <th>User</th>
    <th>Title</th>
    <th>Created</th>
</tr>
</thead>
<tbody>
<?php if($records->num_rows() > 0){ ?>
    <?php foreach($records->result() as $record){ ?>
        <tr>
            <td><?php echo ($record->photo_path!=''?'<img src="'.RIZ_AIRCRAFT_UPLOADS.'photo/'.$record->photo_path.'" height="50px" />':''); ?></td>
            <td><?php echo $record->user_fname.' '.$record->user_lname; ?></td>
            <td><?php echo $record->photo_title; ?></td>
            <td><?php echo date('m/d/Y h:i',$record->photo_created); ?></td>
        </tr>
    <?php } ?>
<?php }else{ ?>
    <tr>
        <td colspan="8"><?php echo RIZ_MSG; ?></td>
    </tr>
<?php } ?>
</tbody>
