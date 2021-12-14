function convertirUnidad(unidadPatron, unidadBase, numero){ //Bar/Pa/1500

    //primero pasamos a Pa
    switch (unidadBase) {
        case 'Bar': numero = numero * 100_000; break; // de Bar a Pa
        case 'mHg': numero = (numero * 133.3223684) / 0.001; break; //de mHg a Pa
        case 'mH2O': numero = numero / 0.00010197442889221; break; //de mH2O a Pa
        case 'kg/cm²': numero = numero / 98066.5; break; //de kg/cm² a Pa
        case 'PSI': numero = numero / 6894.76; break; //de PSI a Pa
        default: numero = numero * 1;
    }

    //luego pasamos de Pa a la Unidad del Patron
    switch (unidadPatron) {
        case 'Bar': numero = numero / 100_000; break; // de Pa a Bar
        case 'mHg': numero = (numero / 133.3223684) * 0.001; break; //de Pa a mHg
        case 'mH2O': numero = numero * 0.00010197442889221; break; //de Pa a mH20
        case 'kg/cm²': numero = numero * 98066.5; break; //de Pa a kg/cm²
        case 'PSI': numero = numero * 6894.76; break; //de Pa a PSI
        default: numero = numero * 1;
    }

    //const unidad = { numero, unidadPatron };
    return numero;
}


export default convertirUnidad;
