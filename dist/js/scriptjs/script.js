// script ajax form login(status)
$(document).ready(function() {

    $("form input#username").on("keyup", function() {
        let value = $("form input#username").val();
        $("form div#status").load("components/status_load.php?k="+value);
    });

});