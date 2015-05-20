<?php	

if ( ! defined('ABSPATH')) exit; // if direct access 
	
?>

<div class="wrap">
	<div id="icon-tools" class="icon32"><br></div><?php echo "<h2>".__('ParaAdmin Demo', 'your_text_domain')."</h2>";

	// unique id to save option
	$slug_options_id = 'slug_options'; 


	// tab list
	$slug_options_tabs = array(
								'tab1'=>'<i class="fa fa-sign-in"></i> Tab 1',
								'tab2'=>'<i class="fa fa-share-alt"></i> Tab 2',
								
								);
	
	// Option parameter by tab1
	$slug_options['tab1'] = array(
					'paraadmin_test'=>array(
						'css_class'=>'paraadmin_test',					
						'title'=>'<i class="fa fa-share-alt"></i> Demo text field.',
						'option_details'=>'Demo text details.',						
						'input_type'=>'text', // text, radio, checkbox, select, 
						'input_values'=>'dummy value', // could be array
						),
						
					'paraadmin_textarea'=>array(
						'css_class'=>'paraadmin_textarea',					
						'title'=>'Demo textarea.',
						'option_details'=>'Demo textarea details.',						
						'input_type'=>'textarea', // text, radio, checkbox, select, 
						'input_values'=>'dummy value', // could be array							
						),						
					'paraadmin_checkbox'=>array(
						'css_class'=>'paraadmin_checkbox',
						'title'=>'Demo checkbox.',
						'option_details'=>'Demo checkbox details.',
						'input_type'=>'checkbox', // text, radio, checkbox, select, 
						'input_values'=>array(	'paraadmin_checkbox1'=>'Checkbox 1',
												'paraadmin_checkbox2'=>'Checkbox 2',
												'paraadmin_checkbox3'=>'Checkbox 3',
						
						
																	
												), // could be array						
						),	
					'paraadmin_radio'=>array(
						'css_class'=>'paraadmin_radio',
						'title'=>'Demo radio',
						'option_details'=>'Demo radio details.',
						'input_type'=>'radio', // text, radio, checkbox, select, 
						'input_values'=>array(	'radio1'=>'Radio 1',
												'radio2'=>'Radio 2',
												'radio3'=>'Radio 3',												
												'radio4'=>'Radio 4',												
												), // could be array						
						),
						
					'paraadmin_select'=>array(
						'css_class'=>'paraadmin_member_position',
						'title'=>'Demo select.',
						'option_details'=>'Demo select details.',
						'input_type'=>'select', // text, radio, checkbox, select, 
						'input_values'=>array(	'option1'=>'Option 1',
												'option2'=>'Option 2',
												'option3'=>'Option 3',												
												'option4'=>'Option 4',												
												), // could be array							
						),
						
					'paraadmin_file'=>array(
						'css_class'=>'paraadmin_file',
						'title'=>'Demo file.',
						'option_details'=>'Demo file details.',
						'input_type'=>'file', // text, radio, checkbox, select, 
						'input_values'=>'', // could be array							
						),			
						
					'paraadmin_editor'=>array(
						'css_class'=>'paraadmin_editor',					
						'title'=>'Demo Editor',
						'option_details'=>'Demo Editor details.',						
						'input_type'=>'editor', // text, radio, checkbox, select, 
						'input_values'=>'Test value', // could be array							
						),	
												

					);
					
					
	// Option parameter by tab2		
	$slug_options['tab2'] = array(
	
	

	
	
	
					'paraadmin_textarea_tab2'=>array(
						'css_class'=>'paraadmin_textarea_tab2',					
						'title'=>'Demo textarea',
						'option_details'=>'Demo textarea details.',						
						'input_type'=>'textarea', // text, radio, checkbox, select, 
						'input_values'=>'test value', // could be array							
						),
	
	
	
					'paraadmin_text_tab2'=>array(
						'css_class'=>'paraadmin_text_tab2',					
						'title'=>'Demo text',
						'option_details'=>'Demo text details.',						
						'input_type'=>'text', // text, radio, checkbox, select, 
						'input_values'=>'test', // could be array							
						),
						
						
					);
					
					
	// define the class
	$slug_display = new paraAdmin();
	
	
	// Display options
	echo $slug_display->option_output($slug_options_id, $slug_options, $slug_options_tabs) ;

?>

</div>
