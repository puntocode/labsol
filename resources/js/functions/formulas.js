function calcularFormula(formula, valores) {
    let resultado = 0;

    switch (formula) {
        case 'u_rep_ebc': resultado = uRepEbcPat(valores.sIEC, valores.n); break;
        case 'u_res_ebc': resultado = uResEbcPat(valores.r, valores.n); break;
        case 'p_inc_res': resultado = uResEbcPat(valores.r, valores.n); break;
        case 'p_inc_rep': resultado = uRepEbcPat(valores.sIP, valores.n); break;
        case 'p_inc_p':   resultado = valores.uk; break;
        default: 0;
    }

    return resultado;
}

function uRepEbcPat(s, n){
    const valor = s / Math.sqrt(n);
    return valor;
}

function uResEbcPat(r, n){
    const valor = r / (2 * Math.sqrt(n));
    return valor;
}



export default calcularFormula;
