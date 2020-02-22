function checkAvailability() {

    $("#loaderIcon").show();
    jQuery.ajax({
        url: "iccludes/check_availability.php",
        data: 'user_email=' + $("#user_email").val(),
        type: "POST",
        success: function (data) {
            $("#user-availability-status").html(data);
            $("#loaderIcon").hide();
        },
        error: function () {}
    });
}

function checkform() {
    if (document.form1.user_email.value === "") {
        alert("Please enter email");
        return false;
    }
    else if(document.form1.user_password.length < 6 || document.form1.user_password.length > 15)
        alert("Bad Password!");
    else {
        document.form1.submit();
    }
}