function convertirUnidad(unidadPatron, unidadBase, promedio){ //Bar/Pa/1500

    //primero pasamos a Pa
    switch (unidadBase) {
        case 'Bar': promedio = promedio * 100_000; break; // de Bar a Pa
        case 'mHg': promedio = (promedio * 133.3223684) / 0.001; break; //de mHg a Pa
        case 'mH2O': promedio = promedio / 0.00010197442889221; break; //de mH2O a Pa
        default: promedio = promedio * 1;
    }

    //luego pasamos de Pa a la Unidad del Patron
    switch (unidadPatron) {
        case 'Bar': promedio = promedio / 100_000; break; // de Pa a Bar
        case 'mHg': promedio = (promedio / 133.3223684) * 0.001; break; //de Pa a mHg
        case 'mH2O': promedio = promedio * 0.00010197442889221; break; //de Pa a mH20
        default: promedio = promedio * 1;
    }

    const unidad = { promedio, unidadPatron };
    return unidad;
}


 export default convertirUnidad;
