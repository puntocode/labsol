function convertirBase(unidad, submultiplo, promedio){

    let arrBase = unidad.split('');
    let arrSub = submultiplo.split('');
    const diferencia = arrSub.filter(elemento => arrBase.indexOf(elemento) == -1);

    switch (diferencia[0]) {
        case 'p': promedio = promedio * 0.000000000001; break;
        case 'n': promedio = promedio * 0.000000001; break;
        case 'μ': promedio = promedio * 0.000001; break;
        case 'm': promedio = promedio * 0.001; break;
        case 'p': promedio = promedio * 0.000000000001; break;
        case 'k': promedio = promedio * 1_000; break;
        case 'M': promedio = promedio * 1_000_000; break;
        case 'G': promedio = promedio * 1_000_000_000; break;
        case 'T': promedio = promedio * 1_000_000_000_000; break;
        case 'P': promedio = promedio * 1_000_000_000_000_000; break;
        default: promedio = promedio * 1;
    }

    const base = { promedio, unidad};
    return base;
}



 export default convertirBase;
