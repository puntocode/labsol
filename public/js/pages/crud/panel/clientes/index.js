const jsonCliente = @json($clientes);

            $("#tableClientes").on("click", ".contacto", function(){
                const id = $(this).data('id');
                const cliente = jsonCliente.find(customer => customer.code == id);
                const contact = cliente.contact;
                if(contact.length > 0){
                    cargarContactoHTML(contact);
                    jQuery.noConflict();
                    $('#modalContacto').modal('show');
                }
            })

            function cargarContactoHTML(contact){
                let html = '';

                contact.forEach(contacto => {
                    let name  = contacto.nombre;
                    let email = contacto.email || '-'
                    let phone = contacto.telefono || '-'
                    let abr   = 'N. N.';

                    if(name == null) return

                    arrayName = name.split(' ')
                    if(arrayName.length == 3 || arrayName.length == 4) arrayName = (arrayName[0]+' '+arrayName[2]).split(' ')
                    if(arrayName.length >= 5) arrayName = (arrayName[0]+' '+arrayName[3]).split(' ')

                    if(arrayName.length == 1) abr = arrayName[0].substring(0,1)
                    else abr = arrayName[0].substring(0,1)+'. '+arrayName[1].substring(0,1)+'.'

                    html += /*html*/
                    `<div class="card p-2 mt-3">
                        <div  class="card-body d-flex p-3">
                            <div class="symbol symbol-50 symbol-light-primary flex-shrink-0 mr-3">
                                <span class="symbol-label font-weight-bold h4 text-uppercase">${abr.toUpperCase()}</span>
                            </div>
                            <div class="d-block">
                                <h4>${name}</h4>
                                <p class="mb-2"><span class="mr-3"><i class="fas fa-envelope-square mr-1"></i>${email}</span></p>
                                <span class="text-black-50"><i class="fas fa-mobile-alt mr-1"></i>${phone}</span>
                            </div>
                        </div>
                    </div>`
                });


                if(html === '') $('#contacto-cliente').html('<div class="text-center">-- No tienes ningun contacto --</div>')
                else $('#contacto-cliente').html(html)

            }
