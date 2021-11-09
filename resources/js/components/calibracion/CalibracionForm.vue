<template>
    <form id="form-step" class="mb-5" autocomplete="off" @submit.prevent="submit">
        <!-- progressbar --------------------------------------------------------------------------------------------------------------------->
        <ul id="progressbar">
            <li class="active" id="basic"><strong>Básicos</strong></li>
            <li :class="this.steps >= 2 ? 'active' : ''" id="status"><strong>Estados</strong></li>
            <li :class="this.steps >= 3 ? 'active' : ''" id="period"><strong>Periodo</strong></li>
            <li :class="this.steps >= 4 ? 'active' : ''" id="period"><strong>Periodo</strong></li>
            <li :class="this.steps == 5 ? 'active' : ''" id="confirm"><strong>Finalizado</strong></li>
            <li :class="this.steps == 5 ? 'active' : ''" id="confirm"><strong>Finalizado</strong></li>
            <li :class="this.steps == 5 ? 'active' : ''" id="confirm"><strong>Finalizado</strong></li>
        </ul>

        <!-- Basico -------------------------------------------------------------------------------------------------------------------------->
        <StepOne :form.sync="form" v-if="this.steps == 1" @click-next="next" />


    </form>
</template>

<script>
    import StepOne from './steps/StepOne'

    export default {
        components: { StepOne, },
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
                form: {}
            }
        },
        //------------------------------------------------------------------------------------

        created () {
            this.fetch();
        },
        //------------------------------------------------------------------------------------

        methods: {
            async fetch() {
                this.form.number = this.data.number;
                this.form.cliente_name = this.data.entrada_instrumentos.cliente.name;
                this.form.instrumento = this.data.instrumentos.name;
            },

            next(){
                this.steps++;
            }
        },


    }
</script>

<style lang="scss" scoped>
#form-step { text-align: center; position: relative; margin-top: 20px;
    fieldset:not(:first-of-type) {display: none;} //selecciona los fieldset que no sea el primer elemento
    .form-card{text-align: left;
        .steps { font-size: 18px; color: gray;}
    }
}

#progressbar {margin-bottom: 30px; overflow: hidden; color: lightgrey; padding: 0;
    li {list-style-type: none; font-size: 12px; width: 14.2%; float: left; position: relative; z-index: 1; font-weight: 400;
        &:before{ width: 30px; height: 30px; display: block; font-size: 15px; color: #ffffff; background: lightgray; border-radius: 50%; margin: 10px auto; padding: 5px;}
        &:after { content: ''; width: 100%; height: 2px; background: lightgray;  left: 0; top: 25px; position: absolute; z-index: -1;}
        &.active:before, &.active::after{background: #009bdd}
    }
    .active {color: #009bdd;}
    #basic:before { font-family: "Font Awesome 5 Free"; content: "\f15c"; }
    #status:before { font-family: "Font Awesome 5 Free"; content: "\f28d"; }
    #period:before { font-family: "Font Awesome 5 Free"; content: "\f073"; }
    #confirm:before { font-family: "Font Awesome 5 Free"; content: "\f058"; }
}
</style>
