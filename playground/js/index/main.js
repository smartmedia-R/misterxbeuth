/**
 * Created with JetBrains PhpStorm.
 * User: asavuskin
 * Date: 16.03.13
 * Time: 23:22
 */
var login= {
    init: function(){
        $("#form").submit(function(){
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'functionality/registration_script.php',
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    if($.trim(data)==='der Eintrag wurde eingefügt'){
                        document.location.href='geheim.php';
                    }if($.trim(data)==="The reCAPTCHA wasn't entered correctly. Go back and try it again."){
                        alert(data);
                        document.location.href='index.php';

                    }else{
                        alert(data);
                    }
                },
                cache: false,
                contentType: false,
                processData: false
            });
            return false;
        });
    }
};
