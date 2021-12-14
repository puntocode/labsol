function encontrarCercanos(array, numero) {
    let proximo = 0;
    const arrayResta = array.map(num =>  Math.abs(num - numero));

    const min = Math.min(...arrayResta);
    const index = arrayResta.indexOf(min);
    const cercano = array[index];

    if(numero <= cercano) proximo = array[index-1];
    else proximo = array[index+1];

    const cercanos = [cercano, proximo];
    cercanos.sort();
    console.log({cercanos})
    return cercanos;
}

export default encontrarCercanos;
