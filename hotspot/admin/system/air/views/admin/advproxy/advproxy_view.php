<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

$potocal = array(
              'name'        => 'potocal_rewrite',
              'id'          => 'potocal_rewrite',
              'value'       => $potocal_rewrite,
              'size'        => '60',
              'style'       => 'width:97%',
            );

?>

			<div class="span12"><div class="widget_heading">
            <?=form_open('admin/advproxy/saveconfig','id="form_advproxy" class="form"')?>
  <h4>Local Network Security</h4>
</div>
<div class="widget_container">
	<?=form_textarea($potocal)?>
    </div>

<div align="right">
<button type="submit" class="button button-blue">Save</button>
</div>
							<?=form_close()?>
						</div>
                    </div>
				</div>