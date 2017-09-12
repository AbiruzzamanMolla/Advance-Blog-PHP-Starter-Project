$(document).ready(function () {
    $('#selectAllBoxs').click(function (event) {
        if (this.checked) {
            $('.checkBoxes').each(function () {
                this.checked = true;
            });
        } else {
            $('.checkBoxes').each(function () {
                this.checked = false;
            });
        }
    });
});



function loadUserOnline() {
    $.get("functions.php?onlineusers=result", function (data) {
        $(".onlineusers").text(data);
    });
}

setInterval(function () {
    loadUserOnline()
}, 500);

