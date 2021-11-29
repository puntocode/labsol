const encontrarK = valor => {
    const k = valor.toFixed(2);

    switch (true) {
        case k < 2:               return 13.97;
        case k >= 2  && k < 3:    return 4.53;
        case k >= 3  && k < 4:    return 3.31;
        case k >= 4  && k < 5:    return 2.87;
        case k >= 5  && k < 6:    return 2.65;
        case k >= 6  && k < 7:    return 2.52;
        case k >= 7  && k < 8:    return 2.43;
        case k >= 8  && k < 9:    return 2.37;
        case k >= 9  && k < 10:   return 2.32;
        case k >= 10 && k < 11:   return 2.28;
        case k >= 11 && k < 12:   return 2.25;
        case k >= 12 && k < 13:   return 2.23;
        case k >= 13 && k < 14:   return 2.21;
        case k >= 14 && k < 15:   return 2.2;
        case k >= 15 && k < 16:   return 2.18;
        case k >= 16 && k < 17:   return 2.17;
        case k >= 17 && k < 18:   return 2.16;
        case k >= 18 && k < 19:   return 2.15;
        case k >= 19 && k < 20:   return 2.14;
        case k >= 20 && k < 25:   return 2.13;
        case k >= 25 && k < 30:   return 2.11;
        case k >= 30 && k < 35:   return 2.09;
        case k >= 35 && k < 40:   return 2.07;
        case k >= 40 && k < 50:   return 2.06;
        case k >= 50 && k <= 100: return 2.06;
        default: return 2;
    }

}

export default encontrarK;

