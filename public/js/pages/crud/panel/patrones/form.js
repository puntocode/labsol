let current_fs, next_fs, previous_fs; //fieldsets
let opacity;
let current = 1;
let steps = $("fieldset").length;

$(".datepicker").datepicker({
    todayHighlight: true,
    orientation: "bottom left"
});

setProgressBar(current);

$(".next").click(function() {
    current_fs = $(this).parent();
    next_fs = $(this)
        .parent()
        .next();

    //Add Class Active
    $("#progressbar li")
        .eq($("fieldset").index(next_fs))
        .addClass("active");

    //show the next fieldset
    next_fs.show();
    //hide the current fieldset with style
    current_fs.animate(
        {
            opacity: 0
        },
        {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    display: "none",
                    position: "relative"
                });
                next_fs.css({
                    opacity: opacity
                });
            },
            duration: 500
        }
    );
    setProgressBar(++current);
});

$(".previous").click(function() {
    current_fs = $(this).parent();
    previous_fs = $(this)
        .parent()
        .prev();

    //Remove class active
    $("#progressbar li")
        .eq($("fieldset").index(current_fs))
        .removeClass("active");

    //show the previous fieldset
    previous_fs.show();

    //hide the current fieldset with style
    current_fs.animate(
        {
            opacity: 0
        },
        {
            step: function(now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    display: "none",
                    position: "relative"
                });
                previous_fs.css({
                    opacity: opacity
                });
            },
            duration: 500
        }
    );
    setProgressBar(--current);
});

function setProgressBar(curStep) {
    let percent = parseFloat(100 / steps) * curStep;
    percent = percent.toFixed();
    $(".progress-bar").css("width", percent + "%");
}

// $(".submit").click(function() {
//     return false;
// })

$("#add-input-rank").on("click", function() {
    let html =
        /*html*/
        `<div class="d-flex mt-4">
        <input type="text" class="form-control" name="rank[0][${inputRank}]">
        <a href="javascript:void(0);" class="btn btn-light-danger ml-3 input-rank-del"><i class="fas fa-trash"></i></a>
    </div>`;

    inputRank++;
    $("#form-rank").append(html);
    // $('#delete-form-contact').attr('disabled', false)
});

$("#form-rank").on("click", ".input-rank-del", function() {
    let div = $(this)
        .parent()
        .parent()
        .children("div")
        .last();
    div.fadeOut().remove();
    inputRank--;
});


form.on('submit', function(e) {
    e.preventDefault();

    const valid = validarForm();
    if(!valid){
        alert($( "#status" ).val())
        toastError('Completa los campos requeridos')
        return
    }

    alert($('input[name="code"]').val())

})

// Funciones-----------------------------------------------------------------------------

function formReset() {
    toastSuccess(msgToas);
    if (create) $("#form-cliente").trigger("reset");
}

function validarForm(){
    if($('#code').val() == '') $('#code').addClass('is-invalid')
    if($('#description').val() == '') $('#description').addClass('is-invalid')
    if($('#status').val() == '0') $('#status').addClass('is-invalid')
    if($('#magnitude').val() == '0') $('#magnitude').addClass('is-invalid')

    if($('#code').val() == '' ||  $('#description').val() == '' || $('#status').val() == '0' || $('#magnitude').val() == '0')return false;
    else return true;

}
