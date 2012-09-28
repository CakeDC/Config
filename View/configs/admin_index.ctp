<h2><?php echo __('Global Application Configuration'); ?></h2>
<?php
	echo $this->Form->create('Config', array('action' => 'index'));
	echo $this->Form->input('front_page_threshold', array(
		'label' => __('Front page Threshold')));
	echo $this->Form->input('max_follwer_cap', array(
		'label' => __('Maximum follower cap')));
	echo $this->Form->input('hash_tag', array(
		'label' => __('Hash Tag')));
	echo $this->Form->input('crock_bar', array(
		'label' => __('Crock Bar'),
		'type' => 'checkbox'));
	echo $this->Form->input('spam_threshold', array(
		'label' => __('Spam Flag Threshold')));
	echo $this->Form->input('wrong_category_threshold', array(
		'label' => __('Incorrect Category Flag Threshold')));
	echo $this->Form->input('inappropriate_content_threshold', array(
		'label' => __('Inappropriate Content Flag Threshold')));
	echo $this->Form->input('adult_content_threshold', array(
		'label' => __('Adult Content Flag Threshold')));
	echo $this->Form->input('landing_page_contest', array(
		'label' => __('Landing Page Contest')));
	echo $this->Form->end(__('Save'));
?>