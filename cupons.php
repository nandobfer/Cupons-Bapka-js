<form action="" id="formFindUser">
    <div class="form-field">    
        <label>CPF: </label>
        <input name="cpf" type="text" placeholder="CPF do Cliente" required>
    </div>
    <input type="hidden" name="action" value="find_user_by_cpf">
    <button type="submit">Buscar</button>
</form>

<div id="userSection">

</div>

<script>
    jQuery('#formFindUser').on('submit', function(e) {
        e.preventDefault();

        var form_data = jQuery(this).serializeArray();
         
        // Here we add our nonce (The one we created on our functions.php. WordPress needs this code to verify if the request comes from a valid source.
        form_data.push( { "name" : "security", "value" : '<?php echo wp_create_nonce( "secure_nonce_name" ); ?>' } );
     
        // Here is the ajax petition.
        jQuery.ajax({
            url : '<?php echo admin_url("admin-ajax.php"); ?>', // Here goes our WordPress AJAX endpoint.
            type : 'post',
            data : form_data,
            success : function( response ) {

                if (response.success == 'true')
                    jQuery('#userSection').css('display', 'block');
                else
                    alert('eita')
            },
            error: function( err ) {
                console.log("Erro na requisição:", err);
            }
        });
         
        // This return prevents the submit event to refresh the page.
        return false;
    });
</script>