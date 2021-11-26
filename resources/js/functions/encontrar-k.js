function encontrarK(valor) {
    let resultado = 0;

    switch (true) {
        case valor < 2:                   resultado = 13.97; break;
        case valor >= 2  && valor < 3:    resultado = 4.53;  break;
        case valor >= 3  && valor < 4:    resultado = 3.31;  break;
        case valor >= 4  && valor < 5:    resultado = 2.87;  break;
        case valor >= 5  && valor < 6:    resultado = 2.65;  break;
        case valor >= 6  && valor < 7:    resultado = 2.52;  break;
        case valor >= 7  && valor < 8:    resultado = 2.43;  break;
        case valor >= 8  && valor < 9:    resultado = 2.37;  break;
        case valor >= 9  && valor < 10:   resultado = 2.32;  break;
        case valor >= 10 && valor < 11:   resultado = 2.28;  break;
        case valor >= 11 && valor < 12:   resultado = 2.25;  break;
        case valor >= 12 && valor < 13:   resultado = 2.23;  break;
        case valor >= 13 && valor < 14:   resultado = 2.21;  break;
        case valor >= 14 && valor < 15:   resultado = 2.2;   break;
        case valor >= 15 && valor < 16:   resultado = 2.18;  break;
        case valor >= 16 && valor < 17:   resultado = 2.17;  break;
        case valor >= 17 && valor < 18:   resultado = 2.16;  break;
        case valor >= 18 && valor < 19:   resultado = 2.15;  break;
        case valor >= 19 && valor < 20:   resultado = 2.14;  break;
        case valor >= 20 && valor < 25:   resultado = 2.13;  break;
        case valor >= 25 && valor < 30:   resultado = 2.11;  break;
        case valor >= 30 && valor < 35:   resultado = 2.09;  break;
        case valor >= 35 && valor < 40:   resultado = 2.07;  break;
        case valor >= 40 && valor < 50:   resultado = 2.06;  break;
        case valor >= 50 && valor <= 100: resultado = 2.06;  break;

        default: 2;
    }

    return resultado;
}

export default encontrarK;

