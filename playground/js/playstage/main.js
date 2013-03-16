/**
 * Created with JetBrains PhpStorm.
 * User: asavuskin
 * Date: 16.03.13
 * Time: 22:27
 */
var move = {
    init: function(){
        $('.standClickable').click(function() {
            if (document.getElementById('id').value == "" && document.getElementById('value').value == "") {
                alert('bitte erst ticket auswählen');
            } else {
                $.ajax({
                    url : 'functionality/move.php',
                    type : 'POST',
                    data : {
                        coord : $(this).attr('id'),
                        ticket : document.getElementById('id').value,
                        value : document.getElementById('value').value
                    },
                    async : false,
                    success : function(data) {
                        document.location.href = 'playstage.php'
                    }
                });
            }
        });
    }
};

function clickButton(id) {
    if ((document.getElementById('id').value == "" && document.getElementById('value').value == "") || id != document.getElementById('id').value) {
        var val = document.getElementById(id).value - 1;
        document.getElementById(id).value = val;
        document.getElementById('id').value = id;
        document.getElementById('value').value = val;
    } else {
        alert('das ticket ist schon ausgewählt')
    }

}