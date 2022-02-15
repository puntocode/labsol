function encontrarRangos(array, numero) {
    return array.find(rango => (rango.desde <= numero && rango.hasta >= numero) );
}

export default encontrarRangos;

