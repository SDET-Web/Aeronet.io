<article class="module width_full">
  <header><h3><?php echo get_pager(); ?><div style="float:right;"><?php echo strtoupper($controller); ?></div></h3></header>
    <div class="module_content">
      <table class="tablesorter" style="width: 100%;" cellspacing="0">
  <thead>
    <tr>
        <th>Question</th>
        <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php if($records->num_rows() > 0){ ?>
    <?php foreach($records->result() as $record){ ?>
    <tr>
      <td><?php echo $record->question; ?></td>
      <td><a class="edit" href="<?php echo site_url('/edit/'.$controller.'/'.$record->id); ?>"><input type="image" src="<?php echo RIZ_SKIN; ?>images/icn_edit.png" title="Edit"></a></td>
    </tr>
    <?php } ?>
    <?php }else{ ?>
    <tr>XC
      <td colspan="8"><?php echo RIZ_MSG; ?></td>
    </tr>
    <?php } ?>
  </tbody>
  </table>

</article>
