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
                <th>N-Number</th>
                <th>Name</th>
                <th>Pilot</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if($records->num_rows() > 0){ ?>
                <?php foreach($records->result() as $record){ ?>
                    <tr>
                        <td><?php echo ($record->photo!=''?'<img src="'.RIZ_AIRCRAFT_UPLOADS.'aircraft/'.$record->photo.'" height="50px" />':''); ?></td>
                        <td><?php echo $record->n_number; ?></td>
                        <td><?php echo $record->name; ?></td>
                        <td><?php echo $record->user_fname.' '.$record->user_lname; ?></td>
                        <td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->air_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->air_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td>
                    </tr>
                <?php } ?>
            <?php }else{ ?>
                <tr>
                    <td colspan="8"><?php echo RIZ_MSG; ?></td>
                </tr>
            <?php } ?>
            </tbody>
