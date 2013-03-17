/**
 * Created with JetBrains PhpStorm.
 * User: asavuskin
 * Date: 16.03.13
 * Time: 23:01
 */
var choose_actor ={
   init: function () {
       $('#actor').submit(function(){
           var formData = new FormData($(this)[0]);
           $.ajax({
               url: 'functionality/choose_actor.php',
               type: 'POST',
               data: formData,
               async: false,
               success: function (data) {
                   if($.trim(data)==='MisterX' || $.trim(data)==='Detektiv' ){
                       alert(data);
                       document.location.href='playstage.php';
                   }else if($.trim(data)==='MisterX_Actor ist schon belegt, bitte wählen Sie Detectiv als Actor' ||
                       $.trim(data)==='Detektiv_Actor ist schon belegt, bitte wählen Sie MisterX als Actor'){
                       alert(data);
                       document.location.href='geheim.php';
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