const convertirBaseInverso = (submultiplo, numero) => {

    switch (submultiplo) {
        case 'p': return numero / 0.000000000001;
        case 'n': return numero / 0.000000001;
        case 'μ': return numero / 0.000001;
        case 'm': return numero / 0.001;
        case 'p': return numero / 0.000000000001;
        case 'k': return numero / 1_000;
        case 'M': return numero / 1_000_000;
        case 'G': return numero / 1_000_000_000;
        case 'T': return numero / 1_000_000_000_000;
        case 'P': return numero / 1000000000000000;
        default: return numero;
    }

}


export default convertirBaseInverso;
