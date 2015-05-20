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
				$html = '';
				
				
				if(empty($_POST[$slug_options_id.'_hidden']))
					{
				
						$slug_options = get_option( 'slug_options' );
					}
				else
					{	
						if($_POST[$slug_options_id.'_hidden'] == 'Y') {
				
							$slug_options = $_POST[$slug_options_id];
							update_option($slug_options_id, $slug_options);
							
							$html .= '<div class="updated"><p><strong>Changes Saved</strong></p></div>';

							} 
					}
				

				$html .= '<form  method="post" action="'.str_replace( "%7E", "~", $_SERVER["REQUEST_URI"]).'">';				
				
				$html .= '<input type="hidden" name="'.$slug_options_id.'_hidden" value="Y">';				
				
				$html .= settings_fields( 'slug_options' );
				$html .=  do_settings_sections( 'slug_options' );
				
				
				
				
				
				
				
				$html .= '<div class="para-settings">';
				
				$html .= '<ul class="tab-nav">';	
				
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
							
						$html.= '<li nav="'.$i.'" class="tab'.$i.' '.$active.' ">'.$tabs.'</li>';
						
						$i++;
					}
				$html .= '</ul>';
				
				
								
				$html .= '<ul class="box">';
				
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
						$html.= '<li style="display: '.$display.';" class="box'.$j.' tab-box '.$active.'">';
							foreach($options_all[$id] as $id => $options)
								{
									foreach($options as $option)
									
									$css_class = $options['css_class'];						
									$title = $options['title'];
									$option_details = $options['option_details'];						
									$input_type = $options['input_type'];						
									$input_values = $options['input_values'];						
									
									$html.= '<div class="option-box">';
									
									$html.= '<p class="option-title">'.$title.'</p>';
									$html.= '<p class="option-info">'.$option_details.'</p>';
									
									$html.= $this->input_type($slug_options_id, $input_type, $input_values, $id, $css_class);
									
									$html.= '</div>';
									
								}
						$html.= '</li>';						
						
						$j++;
					}
				$html .= '</ul>';
							
							
							
							
										

					
					
				$html .= '</div>';
				
				
				$html .= '<p class="submit"><input class="button button-primary" type="submit" name="Submit" value="Save Changes" /></p></form>';				
				
				
				
				
				return $html;
				
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

						
						$html.= '<input name="'.$slug_options_id.'['.$id.']" type="text" value="'.$option_id_value.'" id="'.$id.'" class="'.$css_class.'" />';
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
						
						
						
						$html.= '<textarea name="'.$slug_options_id.'['.$id.']" type="text" id="'.$id.'" class="'.$css_class.'" >'.$value.'</textarea>';
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
								
								
								
								$html.= '<label>';
								
								$html.= '<input name="'.$slug_options_id.'['.$key.']" type="checkbox" '.$checked.' value="1" id="'.$key.'" class="'.$css_class.'" /> '.$value;
								$html.= '</label><br />';
							}
					

					}
					
				elseif($input_type == 'select')
					{
						
						
						$html.= '<select name="'.$slug_options_id.'['.$id.']" id="'.$id.'" class="'.$css_class.'">';
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
									
									
									
									$html.= '<option '.$selected.'  value="'.$key.'" >'.$value.'</option>';
								}
						$html.= '</select>';
						
					}
					
					
				elseif($input_type == 'radio')
					{

						foreach($input_values as $key => $value)
							{
								$html.= '<label>';
								
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
								
								
								
								
								$html.= '<input '.$checked.'  class="'.$css_class.'" id="'.$key.'" type="radio" name="'.$slug_options_id.'['.$id.']" value="'.$key.'" >'.$value.'</option> ';
								$html.= '</label><br />';
							}

						
					}					
					
				if($input_type == 'file')
					{
								
						$option_id_value = $slug_options[$id];
							if(empty($option_id_value))
								{
									$option_id_value = $input_values;
								}


						
						$html.= '
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
					
									
									
				
				
				return $html;
			}
					
	}
	
}
