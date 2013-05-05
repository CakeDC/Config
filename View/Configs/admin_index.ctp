<h2><?php echo __('Global Application Configuration'); ?></h2>
<?php
	echo $this->Form->create('Config', array('action' => 'index'));
	echo $this->Form->input('config_first_param');
	echo $this->Form->end(__('Save'));
?>