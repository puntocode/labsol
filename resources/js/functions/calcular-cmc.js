
import encontrarRangos from './encontrar-rangos'
import convertirUnidad from './convertir-unidad'
import convertirBase from './convertir-base'

const calcularCMC = async(ip, uMedida, cmcs) => {
    try{
        let unidadPatronCMC = cmcs[0].patron_medida;
        let newIp = ip;

        if(uMedida != unidadPatronCMC) newIp = convertirUnidad(unidadPatronCMC, uMedida, ip);

        //convertimos todos los cmc a unidad base del Cmc
        const cmcConvertido = await convertirCmcABase(cmcs, unidadPatronCMC);
        console.log(cmcConvertido)
        const rango = encontrarRangos(cmcConvertido, newIp);

        return rango;
    }catch(err){
        console.error(err);
    }
}


//Convertimos todos los datos del cmc a unidad del Patron IDE
const convertirCmcABase = (cmcs, unidadPatronCMC) => {
    return cmcs.map(cmc => {
        let rangoA = cmc.rango_a;
        let rangoDe = cmc.rango_de;
        let cmcValor = cmc.cmc

        if(cmc.rango_unidad != unidadPatronCMC){
            const arrSub = cmc.rango_unidad.split('');
            const diferencia = arrSub[0];
            rangoA = convertirBase(diferencia, rangoA);
            rangoDe = convertirBase(diferencia, rangoDe);
        }

        if(cmc.cmc_unidad !== unidadPatronCMC){
            const arrSub = cmc.cmc_unidad.split('');
            const diferencia = arrSub[0];
            cmcValor = convertirBase(diferencia, cmcValor);
        }

        const data = { cmc: cmcValor, hasta: rangoA, desde: rangoDe, unidad: unidadPatronCMC }
        return data;
    });

}




export default calcularCMC;
