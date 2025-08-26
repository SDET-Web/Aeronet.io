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
                <th>First Name</th>
                <th>Last Name</th>
                <th>Street</th>
                <th>City</th>
                <th>Med Date</th>
                <th>Med Exp Date</th>
                <th>Type</th>
            </tr>
            </thead>
            <tbody>
            <?php if($records->num_rows() > 0){ ?>
                <?php foreach($records->result() as $record){ ?>
                    <tr>
                        <td><?php echo $record->unique_id; ?></td>
                        <td><?php echo $record->first_name; ?></td>
                        <td><?php echo $record->last_name; ?></td>
                        <td><?php echo $record->street1; ?></td>
                        <td><?php echo $record->city; ?></td>
                        <td><?php echo $record->med_date != '/'?$record->med_date:'No specified'; ?></td>
                        <td><?php echo $record->med_exp_date != 0?$record->med_exp_date:'No specified'; ?></td>
                        <td><a class="edit" href="<?php echo site_url('/edit/directory_pilot/'.$record->unique_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->unique_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td>
                    </tr>
                <?php } ?>
            <?php }else{ ?>
                <tr>
                    <td colspan="8"><?php echo RIZ_MSG; ?></td>
                </tr>
            <?php } ?>
            </tbody>
