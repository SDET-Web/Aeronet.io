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
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php if($records->num_rows() > 0){ ?>
                <?php foreach($records->result() as $record){ ?>
                    <tr>
                        <td><?php echo $record->news_id; ?></td>
                        <td><?php echo $record->news_title; ?></td>
                        <td><?php echo $record->news_type; ?></td>
                        <td><?php echo date("d F",$record->news_date); ?></td>
                        <td><a class="edit" href="<?php echo site_url('/edit/news/'.$record->news_id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a><a class="delete" href="?delete=<?php echo $record->news_id; ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_trash.png" title="Trash"></a></td>
                    </tr>
                <?php } ?>
            <?php }else{ ?>
                <tr>
                    <td colspan="8"><?php echo RIZ_MSG; ?></td>
                </tr>
            <?php } ?>
            </tbody>
