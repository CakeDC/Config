<h2><?php __('Global Application Configuration'); ?></h2>
<?php
	echo $form->create('Configuration', array('action' => 'index'));
	echo $form->input('front_page_threshold', array(
		'label' => __('Front page Threshold', true)));
	echo $form->input('max_follwer_cap', array(
		'label' => __('Maximum follower cap', true)));
	echo $form->input('hash_tag', array(
		'label' => __('Hash Tag', true)));
	echo $form->input('crock_bar', array(
		'label' => __('Crock Bar', true),
		'type' => 'checkbox'));
	echo $form->input('spam_threshold', array(
		'label' => __('Spam Flag Threshold', true)));
	echo $form->input('wrong_category_threshold', array(
		'label' => __('Incorrect Category Flag Threshold', true)));
	echo $form->input('inappropriate_content_threshold', array(
		'label' => __('Inappropriate Content Flag Threshold', true)));
	echo $form->input('adult_content_threshold', array(
		'label' => __('Adult Content Flag Threshold', true)));
	echo $form->input('landing_page_contest', array(
		'label' => __('Landing Page Contest', true)));
	echo $form->end(__('Save', true));
?>