
function calcularDes(arr){

    const contador = arr.length;
    let sum = arr.reduce((previous, current) => current += previous);
    let avg = sum / contador;

    const x = arr.map( valor => (valor-avg) ** 2 );
    const suma = x.reduce((anterior, siguiente) => siguiente += anterior);
    const desviacion = (suma / (contador-1)) ** 0.5;

    return desviacion;
}

export default calcularDes;
