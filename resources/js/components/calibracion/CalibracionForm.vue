<template>
    <form id="form-step" class="mb-5" autocomplete="off" @submit.prevent="submit">
        <!-- progressbar ---------------------------------------------------------------------------------------------------------------->
        <ul id="progressbar">
            <li :class="activeOne" class="basic"><strong>Datos</strong></li>
            <li :class="activeTwo" class="basic"><strong>Patrones</strong></li>
            <li :class="activeThree" class="basic"><strong>Iniciales</strong></li>
            <li :class="activeFour" class="basic"><strong>Valores</strong></li>
            <li :class="activeFive" class="basic"><strong>Finales</strong></li>
            <li :class="{ succ: steps == 6 }" id="confirm"><strong>Terminado</strong></li>
        </ul>

        <!-- paso 1 --------------------------------------------------------------------------------------------------------------------->
        <step-one
            :form.sync="form"
            :datos="datos"
            :medida="magnitud"
            @click-next="next"
            v-if="this.steps == 1">
            <h2 class="font-weight-bold">Datos del Equipo Calibrado:</h2>
            <span class="steps">Paso {{steps}} - 6</span>
        </step-one>

        <!-- paso 2 --------------------------------------------------------------------------------------------------------------------->
        <step-two
            :form.sync="form"
            :datos="datos"
            @click-next="next"
            v-if="this.steps == 2">
            <h2 class="font-weight-bold">Patrones utilizados:</h2>
            <span class="steps">Paso {{steps}} - 6</span>
        </step-two>

        <!-- paso 3 --------------------------------------------------------------------------------------------------------------------->
        <step-three
            :form.sync="form"
            :datos="datos"
            @click-next="next"
            v-if="this.steps == 3">
            <h2 class="font-weight-bold">Datos iniciales de Calibración:</h2>
            <span class="steps">Paso {{steps}} - 6</span>
        </step-three>

        <!-- paso 4 --------------------------------------------------------------------------------------------------------------------->
        <step-four
            :form.sync="form"
            :medida="magnitud"
            :incertidumbres="data.instrumentos.procedimiento[0].incertidumbres"
            :datos="datos"
            @click-next="next"
            v-if="this.steps == 4">
            <h2 class="font-weight-bold">Valores Obtenidos:</h2>
            <span class="steps">Paso {{steps}} - 6</span>
        </step-four>

        <!-- paso 5 --------------------------------------------------------------------------------------------------------------------->
        <step-five
            :form.sync="form"
            :datos="datos"
            @click-next="next"
            v-if="this.steps == 5">
            <h2 class="font-weight-bold">Datos finales de Calibración:</h2>
            <span class="steps">Paso {{steps}} - 6</span>
        </step-five>

        <!-- paso 6 --------------------------------------------------------------------------------------------------------------------->
        <step-six v-if="this.steps == 6">
            <h2 class="font-weight-bold">Calibración Finalizada:</h2>
            <span class="steps">Paso {{steps}} - 6</span>
        </step-six>
    </form>
</template>

<script>
    import StepOne from './steps/StepOne';
    import StepTwo from './steps/StepTwo';
    import StepThree from './steps/StepThree';
    import StepFour from './steps/StepFour';
    import StepFive from './steps/StepFive';
    import StepSix from './steps/StepSix';

    export default {
        components: { StepOne, StepTwo, StepThree, StepFive, StepSix, StepFour },
        props: {
            data: {
                type: Object,
                default: {},
            },
        },
        //------------------------------------------------------------------------------------

        data() {
            return {
                steps: 1,
                form: {},
                datos: {},
                magnitud: [],
                incertidumbres: {}
            }
        },
        //------------------------------------------------------------------------------------

        created () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        methods: {
            async fetch() {
                this.form = {...this.data.calibracion};
                this.datos.number = this.data.number;
                this.datos.cliente_name = this.data.entrada_instrumentos.cliente.name;
                this.datos.instrumento = this.data.instrumentos.name;
                this.datos.general = this.data.entrada_instrumentos.obs_general;
                this.datos.procedimiento = this.data.instrumentos.procedimiento[0];
                this.datos.tipo = this.data.type;
                this.magnitud = this.data.instrumentos.procedimiento[0].magnitud;


                // const incertidumbreEbc = [
                //     {
                //         contribucion: 'EBC',
                //         nombre: 'Incertidumbre repetibilidad EBC',
                //         tipo: 'A',
                //         distribucion: 'normal',
                //         formula: 'u_rep_ebc',
                //         fuente: '𝑠',
                //         divisor: '√3',
                //         contribucion_u:  0,
                //         coeficiente: 1,
                //         contribucion_du: 1,
                //         u_du: 0,
                //         grados_libertad_for: 'n-1',
                //         grados_libertad: 0
                //     },
                //     {
                //         contribucion: 'EBC',
                //         nombre: 'Incertidumbre resolución EBC',
                //         tipo: 'B',
                //         distribucion: 'rectangular',
                //         formula: 'u_res_ebc',
                //         fuente: '𝑟/2',
                //         divisor: '√3',
                //         contribucion_u:  0,
                //         coeficiente: 1,
                //         contribucion_du: 1,
                //         u_du: 0,
                //         grados_libertad_for: '∞',
                //         grados_libertad: '∞'
                //     },
                // ];

                // const incertidumbrePatron = [
                //     {
                //         contribucion: 'PATRON',
                //         nombre: 'Incertidumbre patrón',
                //         tipo: 'B',
                //         distribucion: 'normal',
                //         formula: 'p_inc_p',
                //         fuente: 'U',
                //         divisor: 'k',
                //         contribucion_u:  0,
                //         coeficiente: 1,
                //         contribucion_du: 1,
                //         u_du: 0,
                //         grados_libertad_for: '∞',
                //         grados_libertad: '∞'
                //     },
                //     {
                //         contribucion: 'PATRON',
                //         nombre: 'Incertidumbre resolución EBC',
                //         tipo: 'B',
                //         distribucion: 'rectangular',
                //         formula: 'p_inc_res',
                //         fuente: '𝑟/2',
                //         divisor: '√3',
                //         contribucion_u:  0,
                //         coeficiente: 1,
                //         contribucion_du: 1,
                //         u_du: 0,
                //         grados_libertad_for: '∞',
                //         grados_libertad: '∞'
                //     },
                //     {
                //         contribucion: 'PATRON',
                //         nombre: 'Incertidumbre repetibilidad patrón',
                //         tipo: 'A',
                //         distribucion: 'normal',
                //         formula: 'p_inc_rep',
                //         fuente: '𝑠',
                //         divisor: '√3',
                //         contribucion_u:  0,
                //         coeficiente: 1,
                //         contribucion_du: 1,
                //         u_du: 0,
                //         grados_libertad_for: 'n-1',
                //         grados_libertad: 0
                //     },
                // ];

                //this.incertidumbres = this.data.instrumentos.procedimiento[0].incertidumbres.map(objeto => ({...objeto}));
                //let incertidumbreEbc = incertidumbres.filter(ebc => ebc.contribucion === 'EBC' );
                //let incertidumbrePatron = incertidumbres.filter(patron => patron.contribucion === 'PATRON');

                //this.incertidumbres = { ebc: incertidumbreEbc, patron: incertidumbrePatron}
            },

            next(){
                this.steps++;
            }
        },
        //------------------------------------------------------------------------------------

        computed: {
            activeOne() {
                return this.steps >= 1 && this.steps != 6 ? 'active' : 'succ';
            },
            activeTwo() {
                if(this.steps < 2) return;
                return this.steps >= 2 && this.steps != 6 ? 'active' : 'succ';
            },
            activeThree() {
                if(this.steps < 3) return;
                return this.steps >= 3 && this.steps != 6 ? 'active' : 'succ';
            },
            activeFour() {
                if(this.steps < 4) return;
                return this.steps >= 4 && this.steps != 6 ? 'active' : 'succ';
            },
            activeFive() {
                if(this.steps < 5) return;
                return this.steps >= 5 && this.steps != 6 ? 'active' : 'succ';
            },
        },
    }
</script>

<style lang="scss" scoped>
#form-step { text-align: center; position: relative; margin-top: 20px;
    fieldset:not(:first-of-type) {display: none;} //selecciona los fieldset que no sea el primer elemento
    .form-card{text-align: left;
        .steps { font-size: 18px; color: #afafaf;}
    }
}

#progressbar {margin-bottom: 30px; overflow: hidden; color: lightgrey; padding: 0;
    li {list-style-type: none; font-size: 12px; width: 16.6%; float: left; position: relative; z-index: 1; font-weight: 400;
        &:before{ width: 30px; height: 30px; display: block; font-size: 15px; color: #ffffff; background: lightgray; border-radius: 50%; margin: 10px auto; padding: 5px;}
        &:after { content: ''; width: 100%; height: 2px; background: lightgray;  left: 0; top: 25px; position: absolute; z-index: -1;}
        &.active:before, &.active::after{background: #009bdd}
        &.succ:before, &.succ::after{background: #4bb71b}
    }
    .active{color: #009bdd;}
    .succ{color: #4bb71b;}
    .basic:before { font-family: "Font Awesome 5 Free"; content: "\f15c"; }
    #confirm:before { font-family: "Font Awesome 5 Free"; content: "\f058"; }
}
</style>
