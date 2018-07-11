<?php
/*
Template Name: Comming soon
 */
get_header(); ?>
<div class="div">
    <div class="div_center">
        <div class="comming">
            <script type="text/javascript">
                //auto expand textarea
                function adjust_textarea(h) {
                    h.style.height = "20px";
                    h.style.height = (h.scrollHeight)+"px";
                }
            </script>
            <style type="text/css">
.form-style-7{
    max-width:500px;
    margin:50px auto;
    background:#fff;
    border-radius:2px;
    padding:20px;
    font-family: Georgia, "Times New Roman", Times, serif;
}
.form-style-7 h1{
    display: block;
    text-align: center;
    padding: 0;
    margin: 0px 0px 20px 0px;
    color: #5C5C5C;
    font-size:x-large;
}
.form-style-7 ul{
    list-style:none;
    padding:0;
    margin:0;  
}
.form-style-7 li{
    display: block;
    padding: 9px;
    border:1px solid #DDDDDD;
    margin-bottom: 30px;
    border-radius: 3px;
}
.form-style-7 li:last-child{
    border:none;
    margin-bottom: 0px;
    text-align: center;
}
.form-style-7 li > label{
    display: block;
    float: left;
    margin-top: -21px;
    background: #FFFFFF;
    height: 14px;
    padding: 2px 5px 2px 5px;
    color: #B9B9B9;
    font-size: 14px;
    font-family: Arial, Helvetica, sans-serif;
}
.form-style-7 input[type="text"],
.form-style-7 input[type="date"],
.form-style-7 input[type="datetime"],
.form-style-7 input[type="email"],
.form-style-7 input[type="number"],
.form-style-7 input[type="search"],
.form-style-7 input[type="time"],
.form-style-7 input[type="url"],
.form-style-7 input[type="password"],
.form-style-7 input[type="tel"],
.form-style-7 input[type="file"],
.form-style-7 textarea,
.form-style-7 select
{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    width: 100%;
    display: block;
    outline: none;
    border: none;
    height: 25px;
    line-height: 25px;
    font-size: 16px;
    padding: 0;
    font-family: Georgia, "Times New Roman", Times, serif;
}
.form-style-7 input[type="text"]:focus,
.form-style-7 input[type="date"]:focus,
.form-style-7 input[type="datetime"]:focus,
.form-style-7 input[type="email"]:focus,
.form-style-7 input[type="number"]:focus,
.form-style-7 input[type="search"]:focus,
.form-style-7 input[type="time"]:focus,
.form-style-7 input[type="url"]:focus,
.form-style-7 input[type="tel"],
.form-style-7 input[type="file"],
.form-style-7 input[type="password"]:focus,
.form-style-7 textarea:focus,
.form-style-7 select:focus
{
}
.form-style-7 li > span{
    background: #0C4CA3;
    display: block;
    padding: 3px;
    margin: 0 -9px -9px -9px;
    text-align: center;
    color: #fff;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 11px;
}
.form-style-7 textarea{
    resize:none;
}
.form-style-7 input[type="submit"],
.form-style-7 input[type="button"]{
    background: #0C4CA3;
    border: none;
    padding: 10px 20px 10px 20px;
    border-bottom: 3px solid #5994FF;
    border-radius: 3px;
    color: #FFF;
}
.form-style-7 input[type="submit"]:hover,
.form-style-7 input[type="button"]:hover{
    background: #0C4CA3;
    color:#fff;
}

<?php
if(isset($_POST['sub-button'])){
    $upload_name = $_FILES['bio']['name'];
	$uploadOk = 1;
    $to = 'georgi.nqgolov@gmail.com';
    $subject = 'The subject';
    $body = 'The email body content';
    $headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    global $wpdb;
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );   

    if ( ! function_exists( 'wp_handle_upload' ) ) {
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
    }
    $uploadedfile = $_FILES['bio'];

    
    $attachments = array();

     $upload_overrides = array( 'test_form' => false );

    foreach ( $uploadedfile['name'] as $key => $valve ) {

     		$file = array(
                'name'     => $uploadedfile[ 'name' ][ $key ],
                'type'     => $uploadedfile[ 'type' ][ $key ],
                'tmp_name' => $uploadedfile[ 'tmp_name' ][ $key ],
                'error'    => $uploadedfile[ 'error' ][ $key ],
                'size'     => $uploadedfile[ 'size' ][ $key ]
     		);
	     	$get_pathinfo = pathinfo(wp_upload_dir() . $file[name]);
	     	$file_extension = $get_pathinfo['extension'];

			if($file_extension != "cv" && $file_extension != "docx" && $file_extension != "pdf") {
			    $file_err =  "Sorry, only .cv, .docx, .pdf files are allowed.";
			    $uploadOk = 0;
			}else{
				if($file["size"] <= 50000000){
					$movefile = wp_handle_upload( $file, $upload_overrides );
		    		$attachments[] = $movefile[ 'file' ];
				}else{
					$file_err =  "Large files";
				    $uploadOk = 0;
				}
			}
		     		
    }


    $name = trim(stripslashes(htmlspecialchars($_POST['p_name'])));
    $email = trim(stripslashes(htmlspecialchars($_POST['email'])));
    $ver_email = trim(stripslashes(htmlspecialchars($_POST['ver_email'])));
    $phone = trim(stripslashes(htmlspecialchars($_POST['phone'])));
    $task_option = $_POST['task_option'];

	if(!empty($name)){
		if(!preg_match("/^[a-zA-Z ]*$/",$name)){
			$name_err = "Only letters and white space allowed";
			$uploadOk = 0;
		}
	}else{
		$name_err = "Name field cant be empty";
		$uploadOk = 0;
	}

	if(!empty($email) || !empty($var_email)){

		if($email != $ver_email){
			$email_err = 'No matching on emails';
			$uploadOk = 0;
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	      	$email_err = "Invalid email format";
	      	$uploadOk = 0;
	    }
	}else{
		$email_err = 'Email forms cant be empty be empty';
		$uploadOk = 0;
	}

	if(empty($phone)){
		$phone_err = 'Phone cant be empty';
		$uploadOk = 0;
	}

// 	if(empty($task_option)){
// 		$task_err = 'Phone cant be empty';
// 		$uploadOk = 0;
// 	}

    if($uploadOk == 0){
		
	}else{
		if(wp_mail('georgi.nqgolov@gmail.com', 'test', $body, $headers, $attachments)){

			foreach ($attachments as $value) {
		        unlink($value);
			}
		}
	}

//    


//     $target_file = basename($uploadedfile['name']);
//     $uploadOk = 1;
//     $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


//     if ($_FILES["bio"]["size"] > 500000) {
//         $uploadOk = 0;
//     }

//     //if($fileType != "" && $fileType != "" && $fileType != "" && $fileType != "" ) {
//     //    $uploadOk = 0;
//     //}

//     if(empty($_POST['name'])){
//         $uploadOk = 0;
//         $err_message = "Can't be empty";
//     }


//     if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
//         $uploadOk = 0;
//         $err_message = "Incorect email";
//     }else{
//         if($_POST['email'] != $_POST['email_2']){
//             $uploadOk = 0;
//             $err_message = "Email don't match please try again";
//         }
//     }

//     if($uploadOk == 0){
        
//     }else{

        
//         if ( $movefile && ! isset( $movefile['error'] ) ) { 
//             $movefile['url'];

//             $y = date("Y");
//             $m = date("m");

//             //$attachments = WP_CONTENT_DIR . '/uploads/2018/07/'. $upload_name;
//             $attachments = WP_CONTENT_DIR . '/uploads/'. $y .'/'. $m .'/'. $upload_name;

//             wp_mail('georgi.nqgolov@gmail.com', 'test', $body, $headers, $attachments);
//             unset($file_delete);

//             $url = get_site_url() . '/wp-content/uploads/'. $y .'/'. $m .'/'. $upload_name;
//             $path = parse_url($url, PHP_URL_PATH);
//             $fullPath = get_home_path() . $path;
//             unlink($fullPath);
//         }
//     }
}
?>



</style>

<form id="" action="" method="post" enctype="multipart/form-data" class="form-style-7">
<ul>
<li>
    <label for="name">Namn: </label>
    <input type="text" name="p_name" maxlength="100">
    <?php if(isset($name_err)){ echo '<span>'. $name_err . '</span>'; } ?>
</li>
<li>
    <label for="email">Mailadress: </label>
    <input type="email" name="email" maxlength="100">
    <?php if(isset($email_err)){ echo '<span>'. $email_err . '</span>'; } ?>
</li>
<li>
    <label for="email">Upprepa mailadress: </label>
    <input type="email" name="ver_email" maxlength="100">
</li>
<li>
    <label for="url">Telefonnummer: </label>
    <input type="tel" name="phone" maxlength="100">
    <?php if(isset($phone_err)){ echo '<span>'. $phone_err . '</span>'; } ?>
</li>
<li>
    <label for="url">Intresserad att arbeta med: </label>
    <select name="task_option">
      <option value=""></option>
      <option value="Bagagevagnshanterin">Bagagevagnshantering</option>
      <option value="Bagagevagnshantering">Hittegods/Effektförvaring</option>
      <option value="Båda">Båda</option>
    </select>
    <?php if(isset($task_err)){ echo '<span>'. $task_err . '</span>'; } ?>
 </li>
<li class="send-file-cree">
    <label for="bio">About You</label>
    <input type="file" name="bio[]" multiple>
    <?php if(isset($file_err)){ echo '<span>'. $file_err . '</span>'; } ?>
</li>
<li style="margin:20px 20px 40px 0px; text-align:start;">
    <label class="gdpr-container">
		Genom att klicka i denna box godkänner du att vi får spara och hantera information om dig för att kunna erbjuda våra tjänster. För mer information besök vår <a href="<?php echo get_site_url(); ?>/se/terms-and-conditions/#privacy-policy-p">Integritetspolicy</a>.<input id="gdpr-check" name="contact_check" checked="checked" type="checkbox">
	    <span class="checkmark"></span>
	</label>
</li>
<li>
    <input type="submit" name="sub-button" value="Send This" >
</li>

</ul>
</form>
        </div>
    </div>
</div>


<?php get_footer(); ?>