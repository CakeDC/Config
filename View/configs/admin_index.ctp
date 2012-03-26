<h2><?php echo __('Global Application Configuration'); ?></h2>
<?php
	echo $form->create('Config', array('action' => 'index'));
	echo $form->input('front_page_threshold', array(
		'label' => __('Front page Threshold')));
	echo $form->input('max_follwer_cap', array(
		'label' => __('Maximum follower cap')));
	echo $form->input('hash_tag', array(
		'label' => __('Hash Tag')));
	echo $form->input('crock_bar', array(
		'label' => __('Crock Bar'),
		'type' => 'checkbox'));
	echo $form->input('spam_threshold', array(
		'label' => __('Spam Flag Threshold')));
	echo $form->input('wrong_category_threshold', array(
		'label' => __('Incorrect Category Flag Threshold')));
	echo $form->input('inappropriate_content_threshold', array(
		'label' => __('Inappropriate Content Flag Threshold')));
	echo $form->input('adult_content_threshold', array(
		'label' => __('Adult Content Flag Threshold')));
	echo $form->input('landing_page_contest', array(
		'label' => __('Landing Page Contest')));
	echo $form->end(__('Save'));
?>