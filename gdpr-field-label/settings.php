<?php

// Register  my custom  menu page
function register_my_custom_menu_page()
{
    add_menu_page(
        __( 'Custom Menu Title', 'textdomain' ),
        'Gdpr Field Label',
        'manage_options',
        'gdpr-field-label/test.php',
        '',
        plugins_url('/images/text-input.png',  __FILE__ )
    );
    add_action('admin_init', 'gdpr_field_label_settings');
}
add_action( 'admin_menu', 'register_my_custom_menu_page' );

function my_enqueue() {
    wp_register_style('options_page_style', plugins_url('css/style.css',__FILE__));
    wp_enqueue_style('options_page_style');
}
add_action( 'admin_enqueue_scripts', 'my_enqueue' );

function gdpr_field_label_settings()
{
    register_setting('gdpr_field_settings', 'color');
    register_setting('gdpr_field_settings', 'name');
    register_setting('gdpr_field_settings', 'email');
    register_setting('gdpr_field_settings', 'subject');
    register_setting('gdpr_field_settings', 'message');
    register_setting('gdpr_field_settings', 're-email');
    register_setting('gdpr_field_settings', 'phone');
    register_setting('gdpr_field_settings', 'options');
    register_setting('gdpr_field_settings', 'gdpr_policy');
    add_settings_section('gdpr-field-section', 'GDPR settings', 'gdpr_callback', 'gdpr-fields-settings');
    add_settings_field('color', 'Change balloon colors', 'update_color' , 'gdpr-fields-settings', 'gdpr-field-section');
    add_settings_field('name_context', 'Change balloon name context ', 'update_name' , 'gdpr-fields-settings', 'gdpr-field-section');
    add_settings_field('email_context', 'Change balloon email context ', 'update_email' , 'gdpr-fields-settings', 'gdpr-field-section');
    add_settings_field('subject_context', 'Change balloon email context ', 'update_subject' , 'gdpr-fields-settings', 'gdpr-field-section');
    add_settings_field('message_context', 'Change balloon email context ', 'update_message' , 'gdpr-fields-settings', 'gdpr-field-section');
    add_settings_field('re_email_context', 'Change balloon email context ', 'update_remail' , 'gdpr-fields-settings', 'gdpr-field-section');
    add_settings_field('phone_context', 'Change balloon email context ', 'update_phone' , 'gdpr-fields-settings', 'gdpr-field-section');

    add_settings_section('gdpr-policy-section', 'GDPR Policy Settings', 'gdpr_callback', 'gdpr-fields-settings');
    add_settings_field('select-page', 'Set privacy policy page', 'update_policy_page' , 'gdpr-fields-settings', 'gdpr-policy-section');
    add_settings_field('select-page1', 'Set terms & conditions page', 'update_policy_page1' , 'gdpr-fields-settings', 'gdpr-policy-section');

}
function gdpr_callback()
{
    echo 'test1';
}

function update_color()
{
    $color = get_option('color');
    echo '<div><input type="color" name="color" value="'.$color.'"></div>';

    return $color;
}

function update_name()
{
    if(!get_option('name'))
    {
        $name = 'This info is collected for the purposes of addressing you.';
    }else{
        $name = get_option('name');
    }
    echo '<div><textarea class="gdpr-text" name="name" value="'.$name.'">'.$name.'</textarea></div>';
}

function update_email()
{
    if(!get_option('email'))
    {
        $email = 'Please include email address if you would like us to respond by email. We collect this information so that we can contact you by email. These details will be transferred to our customer relationship system to enable us to manage your query.';
    }else{
        $email = get_option('email');
    }

    echo '<div><textarea class="gdpr-text" name="email" value="'.$email.'">'.$email.'</textarea></div>';
}

function update_subject()
{
    if(!get_option('subject'))
    {
        $subject = 'Please state clearly the nature of your query.';
    }else{
        $subject = get_option('subject');
    }

    echo '<div><textarea class="gdpr-text" name="subject" value="'.$subject.'">'.$subject.'</textarea></div>';
}

function update_message()
{
    if(!get_option('message'))
    {
        $message = 'The information you provide will be used to contact you regarding your query and for no other reason. It will not be shared with any third party and will be deleted 6 months after our last contact with you.';
    }else{
        $message = get_option('message');
    }

    echo '<div><textarea class="gdpr-text" name="message" value="'.$message.'">'.$message.'</textarea></div>';
}

function update_remail()
{
    if(!get_option('re-email'))
    {
        $re_email = 'Please include email address if you would like us to respond by email. We collect this information so that we can contact you by email. These details will be transferred to our customer relationship system to enable us to manage your query.';
    }else{
        $re_email = get_option('re-email');
    }

    echo '<div><textarea class="gdpr-text" name="re-email" value="'.$re_email.'">'.$re_email.'</textarea></div>';
}

function update_phone()
{
    if(!get_option('phone'))
    {
        $phone = 'Please include phone number if you would like us to respond by phone. We collect this information so that we can contact you by phone. These details will be transferred to our customer relationship system to enable us to manage your query.';
    }else{
        $phone = get_option('phone');
    }

    echo '<div><textarea class="gdpr-text" name="phone" value="'.$phone.'">'.$phone.'</textarea></div>';
}

function update_policy_page()
{ $test = get_option('options'); ?>
    <select name="options" value="<?php echo $test ?>">
 <option name="" value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option>
    <?php $pages = get_pages();
        foreach ( $pages as $page ) {
            if(get_the_title($page->ID) == get_option('options')){
                $select = 'selected="selected"';
                $get_page_name = $page->post_title;
            }else{
                $select = '';
            }
            $option = '<option value="' . get_the_title( $page->ID ) . '"'.$select.'">';
            $option .= $page->post_title;
            $option .= '</option>';
            echo $option;
        }
 ?>
</select>
<?php }

function update_policy_page1()
{ $test = get_option('gdpr_policy'); ?>
    <select name="gdpr_policy" value="<?php echo $test ?>">
 <option name="" value=""><?php echo esc_attr( __( 'Select page' ) ); ?></option>
    <?php $pages = get_pages();
        foreach ( $pages as $page ) {
            if(get_the_title($page->ID) == get_option('gdpr_policy')){
                $select = 'selected="selected"';
                $get_page_name = $page->post_title;
            }else{
                $select = '';
            }
            $option = '<option value="' . get_the_title( $page->ID ) . '"'.$select.'">';
            $option .= $page->post_title;
            $option .= '</option>';
            echo $option;
        }
 ?>
</select>
<?php }


function styles()
{
    echo '<style>
    .tooltipLink
    {
        display: inline-block;
        width: 20px;
        height: 20px;
        background-image: url("'.plugins_url('/images/icons.png',  __FILE__ ).'");
        background-position: -268px -241px;
        cursor: pointer;
        margin-left: 10px;
        position: relative;
    }
    .balloon
    {
        position: absolute !important;
        color: #fff;
        font-family: Lato,Verdana,sans-serif;
        font-size: 14px;
        background-color: '.get_option('color').';
        z-index: 1;
        min-width: 300px;
        width: auto;
        bottom: 30px;
        border-radius: 4px;
        padding: 14px;
        left: 8px;
        display: none;
    }

    .balloon::before
    {
        content: " ";
        border-left: 27px solid '.get_option('color').';
        border-top: 14px solid '.get_option('color').';
        border-right: 27px solid transparent;
        border-bottom: 14px solid transparent;
        position: absolute;
        bottom: -15px;
        left: 10px;

    }


    .container {
        position: relative;
        padding-left: 35px;
        margin-bottom: 12px;
        cursor: pointer;
        font-size: 22px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    
    .container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 25px;
        width: 25px;
        background-color: #eee;
    }
    .container:hover input ~ .checkmark {
        background-color: #ccc;
    }
    .container input:checked ~ .checkmark {
        background-color: #2196F3;
    }
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }
    .container input:checked ~ .checkmark:after {
        display: block;
    }
    .container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    </style>';
}
add_action('wp_head', 'styles');



function my_custom_menu_page(){

   $pages = get_pages();
    foreach ( $pages as $page ) {
        if(get_the_title($page->ID) == get_option('options')){
            $get_page_name = "/".$page->post_name."/";
        }else{
            $get_page_name = get_site_url();
        }

        if(get_the_title($page->ID) == get_option('gdpr_policy')){
            $policy_page = "/".$page->post_name."/";
        }else{
            $policy_page = get_site_url();
        }
    }

    $test = "spam['for=name']";
    echo '<script>
    jQuery(document).ready(function(){
       var name =  jQuery("label[for=name]").length;
       var email =  jQuery("label[for=email]").length;
       var subject =  jQuery("label[for=subject]").length;
       var message =  jQuery("label[for=message]").length;
       var password =  jQuery("label[for=password]").length;
       var re_email =  jQuery("label[for=re-email]").length;
       var phone =  jQuery("label[for=phone]").length;
       var agree =  jQuery("#agree").length;
       if(agree){
            jQuery("#agree").append("<div><spam>If you consent to us using your personal data for that purpose please tick to confirm</spam><div><label class=\'container\'>I Agree<input type=\'checkbox\' checked=\'checked\'><span class=\'checkmark\'></span></label></div><p>For more information please visit our <a href=\''.$get_page_name.'\'>terms & conditions</a> and <a href=\''.$policy_page.'\'>privacy policy</a></p></div>");
        }

       if(name){
           jQuery("label[for=name]").append("<span class=\'tooltipLink closed\'><span class=\'balloon\'>'.get_option('name').'</span></span>");
        }

        if(email){
            jQuery("label[for=email]").append("<span class=\'tooltipLink closed\'><span class=\'balloon\'>'.get_option('email').'</span></span>");
        }

        if(subject){
            jQuery("label[for=subject]").append("<span class=\'tooltipLink closed\'><span class=\'balloon\'>'.get_option('subject').'</span></span>");
        }

        if(message){
            jQuery("label[for=message]").append("<span class=\'tooltipLink closed\'><span class=\'balloon\'>'.get_option('message').'</span></span>");
        }

        if(password){
            jQuery("label[for=password]").append("<span class=\'tooltipLink closed\'><span class=\'balloon\'>Please include email address if you would like us to respond by email. We collect this information so that we can contact you by email. These details will be transferred to our customer relationship system to enable us to manage your query.</span></span>");
        }
        if(re_email){
            jQuery("label[for=re-email]").append("<span class=\'tooltipLink closed\'><span class=\'balloon\'>Please include email address if you would like us to respond by email. We collect this information so that we can contact you by email. These details will be transferred to our customer relationship system to enable us to manage your query.</span></span>");
        }
        if(phone){
            jQuery("label[for=phone]").append("<span class=\'tooltipLink closed\'><span class=\'balloon\'>'.get_option('phone').'</span></span>");
        }

        setTimeout(function()
        {
            jQuery(".tooltipLink").on("click", function(e){
                e.preventDefault();
                jQuery(".tooltipLink").not(jQuery(this)).children().fadeOut();
                jQuery(this).children().fadeIn();
            });

            jQuery(document).click(function(e) {
                var container = jQuery(".tooltipLink");
                if (!container.is(e.target) && container.has(e.target).length === 0)
                {
                    container.children().hide();
                }
            });
        }, 3000);
    });
    </script>';
}
add_action('wp_head', 'my_custom_menu_page');