let contactId = 0;

$('#add-form-contact').on('click', function(){
    contactId ++;
    let html = /*html*/
    `<div class="row w-100 pl-4">
        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label>Dirección <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contact[${contactId}][direccion]">
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label>Nombre <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="contact[${contactId}][nombre]" required>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="contact[${contactId}][email]">
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="form-group">
                <label>Telefono</label>
                <input type="text" class="form-control" name="contact[${contactId}][telefono]">
            </div>
        </div>

        <div class="col-12">
            <hr />
        </div>
    </div>`

    $('#form-contact').append(html).show()
    $('#delete-form-contact').attr('disabled', false)
})

$('#delete-form-contact').on('click', function(){
    $('#form-contact .row').last().remove()
    contactId--
    if(contactId == 0) $('#delete-form-contact').attr('disabled', true)
})

$("#form-cliente").submit(function(e) {
    e.preventDefault();
}).validate({
    rules: {
      name: "required",
      code: { required: true,number: true },
    },
    errorClass: "is-invalid text-danger",
    submitHandler: function(form) {
        $.ajax({
            type: "POST",
            url: $(form).attr('action'),
            data: $(form).serialize(),
            success: function (response) {
                formReset();
            }
        });
        return false;
    }
  });

function formReset(){
    toastSuccess('Cliente insertado correctamente!!')
    $('input[name="name"]').focus();
    $("#form-cliente").trigger("reset");
}
