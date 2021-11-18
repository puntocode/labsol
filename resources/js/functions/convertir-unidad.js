function convertirUnidad(unidadPatron, unidadBase, numero){ //Bar/Pa/1500

    //primero pasamos a Pa
    switch (unidadBase) {
        case 'Bar': numero = numero * 100_000; break; // de Bar a Pa
        case 'mHg': numero = (numero * 133.3223684) / 0.001; break; //de mHg a Pa
        case 'mH2O': numero = numero / 0.00010197442889221; break; //de mH2O a Pa
        default: numero = numero * 1;
    }

    //luego pasamos de Pa a la Unidad del Patron
    switch (unidadPatron) {
        case 'Bar': numero = numero / 100_000; break; // de Pa a Bar
        case 'mHg': numero = (numero / 133.3223684) * 0.001; break; //de Pa a mHg
        case 'mH2O': numero = numero * 0.00010197442889221; break; //de Pa a mH20
        default: numero = numero * 1;
    }

    //const unidad = { numero, unidadPatron };
    return numero;
}


export default convertirUnidad;
