<?php

if ( ! defined('ABSPATH')) exit;  // if direct access 


// ParaAdmin Class
if (!class_exists('paraAdmin')) {
    // generate the class here
class paraAdmin
	{
		var $options = array();
		
		
		function option_output($slug_options_id, $options_all, $options_tabs)
			{
				
				if(empty($_POST[$slug_options_id.'_hidden']))
					{
				
						$slug_options = get_option( 'slug_options' );
					}
				else
					{	
						if($_POST[$slug_options_id.'_hidden'] == 'Y') {
				
							$slug_options = $_POST[$slug_options_id];
							update_option($slug_options_id, $slug_options);
							
							echo '<div class="updated"><p><strong>Changes Saved</strong></p></div>';

							} 
					}
				

				echo '<form  method="post" action="'.str_replace( "%7E", "~", $_SERVER["REQUEST_URI"]).'">';				
				
				echo '<input type="hidden" name="'.$slug_options_id.'_hidden" value="Y">';				
				
				echo settings_fields( 'slug_options' );
				echo  do_settings_sections( 'slug_options' );
				
				
				
				
				
				
				
				echo '<div class="para-settings">';
				
				echo '<ul class="tab-nav">';	
				
				$i=1;			
				foreach($options_tabs as $id => $tabs)
					{
						if($i==1)
							{
								$active = 'active';
							}
						else
							{
								$active = '';
							}
							
						echo '<li nav="'.$i.'" class="tab'.$i.' '.$active.' ">'.$tabs.'</li>';
						
						$i++;
					}
				echo '</ul>';
				
				
								
				echo '<ul class="box">';
				
				$j = 1;
				foreach($options_tabs as $id => $tabs)
					{
						if($j==1)
							{
								$active = 'active';
								$display = 'block';								
							}
						else
							{
								$active = '';
								$display = 'none';	
							}
						echo '<li style="display: '.$display.';" class="box'.$j.' tab-box '.$active.'">';
							foreach($options_all[$id] as $id => $options)
								{
									foreach($options as $option)
									
									$css_class = $options['css_class'];						
									$title = $options['title'];
									$option_details = $options['option_details'];						
									$input_type = $options['input_type'];						
									$input_values = $options['input_values'];						
									
									echo '<div class="option-box">';
									
									echo '<p class="option-title">'.$title.'</p>';
									echo '<p class="option-info">'.$option_details.'</p>';
									
									echo $this->input_type($slug_options_id, $input_type, $input_values, $id, $css_class);
									
									echo '</div>';
									
								}
						echo '</li>';						
						
						$j++;
					}
				echo '</ul>';
							
							
							
							
										

					
					
				echo '</div>';
				
				
				echo '<p class="submit"><input class="button button-primary" type="submit" name="Submit" value="Save Changes" /></p></form>';
				
			}
			
			
		function input_type($slug_options_id, $input_type, $input_values, $id, $css_class)
			{
				
				$slug_options = get_option( $slug_options_id );	
				
				$html ='';
				if($input_type == 'text')
					{
								
						$option_id_value = $slug_options[$id];
							if(empty($option_id_value))
								{
									$option_id_value = $input_values;
								}

						
						echo '<input name="'.$slug_options_id.'['.$id.']" type="text" value="'.$option_id_value.'" id="'.$id.'" class="'.$css_class.'" />';
					}
					
				elseif($input_type == 'textarea')
					{
						if(empty($slug_options[$id]))	
							{
								$slug_options[$id] = '';
							}	
						
						$option_id_value = $slug_options[$id];
						
						if(!empty($option_id_value))
							{
								$value = $option_id_value;
							}
						else
							{
								$value = $input_values;
							}
						
						
						
						echo '<textarea name="'.$slug_options_id.'['.$id.']" type="text" id="'.$id.'" class="'.$css_class.'" >'.$value.'</textarea>';
					}					
					
					
					
					
					
				elseif($input_type == 'checkbox')
					{	
					
						foreach($input_values as $key => $value)
							{
								
								if(empty($slug_options[$key]))
									{
										$slug_options[$key] = '';
									}
								
							$option_key_value = $slug_options[$key];
								if(empty($option_key_value))
									{
										$option_key_value = '';
										$checked = '';
									}
								else
									{
										$checked = 'checked';
									}
								
								
								
								echo '<label>';
								
								echo '<input name="'.$slug_options_id.'['.$key.']" type="checkbox" '.$checked.' value="1" id="'.$key.'" class="'.$css_class.'" /> '.$value;
								echo '</label><br />';
							}
					

					}
					
				elseif($input_type == 'select')
					{
						
						
						echo '<select name="'.$slug_options_id.'['.$id.']" id="'.$id.'" class="'.$css_class.'">';
							foreach($input_values as $key => $value)
								{
									
									
									$option_id_value = $slug_options[$id];
										if($option_id_value == $key )
											{
												$selected = 'selected';
												
											}
										else
											{
												$selected = '';
											}	
									
									
									
									echo '<option '.$selected.'  value="'.$key.'" >'.$value.'</option>';
								}
						echo '</select>';
						
					}
					
					
				elseif($input_type == 'radio')
					{

						foreach($input_values as $key => $value)
							{
								echo '<label>';
								
								//var_dump($key);
								
								$option_id_value = $slug_options[$id];
								if($option_id_value == $key )
									{
										$checked = 'checked';
										
									}
								else
									{
										$checked = '';
									}
								
								
								
								
								echo '<input '.$checked.'  class="'.$css_class.'" id="'.$key.'" type="radio" name="'.$slug_options_id.'['.$id.']" value="'.$key.'" >'.$value.'</option> ';
								echo '</label><br />';
							}

						
					}					
					
					
				elseif($input_type == 'editor')
					{
						
						if(empty($slug_options[$id]))
							{
								$slug_options[$id] = '';
							}
						
								
						$option_id_value = $slug_options[$id];
							if(empty($option_id_value))
								{
									$option_id_value = $input_values;
								}


									wp_editor( stripslashes($option_id_value), $id, $settings = array('textarea_name'=>$slug_options_id.'['.$id.']','editor_height'=>'150px') );

						//echo '<input name="'.$slug_options_id.'['.$id.']" type="text" value="'.$option_id_value.'" id="'.$id.'" class="'.$css_class.'" />';
					}
					
					
					
				elseif($input_type == 'file')
					{
								
						$option_id_value = $slug_options[$id];
							if(empty($option_id_value))
								{
									$option_id_value = $input_values;
								}


						
						echo '
                            <input type="text" size="40" class="'.$css_class.'" id="file_'.$id.'" name="'.$slug_options_id.'['.$id.']" value="'.$option_id_value.'" /><br />
                            <input id="upload_button_'.$id.'" class="upload_button_'.$id.' button" type="button" value="Upload File" />
						
						
						
						
                            <script>
								jQuery(document).ready(function($){
	
									var custom_uploader; 
								 
									jQuery("#upload_button_'.$id.'").click(function(e) {
	
										e.preventDefault();
								 
										//If the uploader object has already been created, reopen the dialog
										if (custom_uploader) {
											custom_uploader.open();
											return;
										}
								
										//Extend the wp.media object
										custom_uploader = wp.media.frames.file_frame = wp.media({
											title: "Choose File",
											button: {
												text: "Choose File"
											},
											multiple: false
										});
								
										//When a file is selected, grab the URL and set it as the text field\'s value
										custom_uploader.on("select", function() {
											attachment = custom_uploader.state().get("selection").first().toJSON();
											jQuery("#file_'.$id.'").val(attachment.url);
										});
								 
										//Open the uploader dialog
										custom_uploader.open();
								 
									});
									
									
								})
							</script>	
						
						
						
						
						
						';
						
						
						
						
						
						
						
					}
					

				
			}
					
	}
	
}
