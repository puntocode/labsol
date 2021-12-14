function toastSuccess(mensaje){
	iziToast.success({
        title: mensaje,
        theme: 'dark',
        position: 'topRight',
        timeout: 3500,
        progressBar: true,
        backgroundColor: '#4FCD64',
    });
}

function toastError(mensaje){
    iziToast.error({
        title: mensaje,
        theme: 'dark',
        position: 'topRight',
        timeout: 3500,
        progressBar: true
    });
}