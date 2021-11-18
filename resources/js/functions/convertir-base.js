function convertirBase(unidad, submultiplo, numero){

    //let arrBase = unidad.split('');
    //const diferencia = arrSub.filter(elemento => arrBase.indexOf(elemento) == -1);
    let arrSub = submultiplo.split('');
    const diferencia = arrSub[0];

    switch (diferencia[0]) {
        case 'p': numero = numero * 0.000000000001; break;
        case 'n': numero = numero * 0.000000001; break;
        case 'μ': numero = numero * 0.000001; break;
        case 'm': numero = numero * 0.001; break;
        case 'p': numero = numero * 0.000000000001; break;
        case 'k': numero = numero * 1_000; break;
        case 'M': numero = numero * 1_000_000; break;
        case 'G': numero = numero * 1_000_000_000; break;
        case 'T': numero = numero * 1_000_000_000_000; break;
        case 'P': numero = numero * 1000000000000000; break;
        default: numero = numero * 1;
    }

    //const base = { numero, unidad };
    return numero;
}



export default convertirBase;
