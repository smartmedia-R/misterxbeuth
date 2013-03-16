/**
 * Created with JetBrains PhpStorm.
 * User: asavuskin
 * Date: 16.03.13
 * Time: 23:26
 */
var login = {
    init: function(){
        $("#loginform").submit(function(){
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: 'functionality/loginScript.php',
                type: 'POST',
                data: formData,
                async: false,
                success: function (data) {
                    if($.trim(data)==="war erfolgreich"){
                        //alert(data);
                        document.location.href='geheim.php';
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
