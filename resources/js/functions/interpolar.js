function interpolar(x, x0, x1, y0, y1) {
    const inter = y0 + ((y1 - y0) / (x1 - x0)) * (x - x0);
    return inter;
}

export default interpolar;

