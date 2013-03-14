/**
 * Created with JetBrains PhpStorm.
 * User: asavuskin
 * Date: 14.03.13
 * Time: 22:27
 * To change this template use File | Settings | File Templates.
 */

function clickButton(id) {
    //entscheide dich endlich, sonst hast du keine ticket mehr!!!!
    if ((document.getElementById('id').value == "" && document.getElementById('value').value == "") || id != document.getElementById('id').value) {

        var val = document.getElementById(id).value - 1;
        document.getElementById(id).value = val;
        document.getElementById('id').value = id;
        document.getElementById('value').value = val;
    } else {
        alert('das ticket ist schon ausgewählt')
    }

}