jQuery(document).ready(function(){

	jQuery('#jobs').submit(function(e){
		e.preventDefault();


        jQuery.ajax({
                url: admin_url.url,
                type: "POST",
                contentType:false,
                processData: false,
                data: function(){
                    var data = new FormData();
                    jQuery.each(jQuery('#fileInput')[0].files, function(i, file) {
                        data.append('file[]', file);
                    });
                    data.append('action', 'jobs_form_handle');
                    data.append('name' , jQuery('#name').val());
                    data.append('email', jQuery('#email').val());
                    data.append('ver_email', jQuery('#ver_email').val());
                    data.append('phone', jQuery('#phone').val());
                    data.append('gdpr-check', jQuery('#gdpr-check').val());
                    data.append('task_option', jQuery('#task_option').val());
                    return data;
                }(),
                success: function(response){
                    console.log(response)
                }
        });
	});
});


