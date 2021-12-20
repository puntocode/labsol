<template>
    <Plotly :data="data" :layout="layout"></Plotly>
</template>

<script>
    import { Plotly } from 'vue-plotly'

    export default {
        props:  ['valores', 'magnitud'],
        components: { Plotly },

        data() {
            return {
                data:[
                    {
                        x: [],
                        y: [],
                        error_y: {
                            type: 'data',
                            array: [],
                            visible: true
                        },
                        type: 'scatter',
                        displayModeBar: false,
                    }
                ],
                layout:{
                    xaxis: {
                      title: `<b>${this.magnitud} (${this.valores[0].unidad})</b>`,
                    },
                    yaxis: {
                      title: '<b>Error + Incertidumbre</b>',
                    }
                }
            }
        },

        created () {
            this.fetch();
        },

        methods: {
            fetch() {
                const DATA_X = this.valores.map(valor => valor.ip);
                const DATA_Y = this.valores.map(valor => valor.e);
                const DATA_E = this.valores.map(valor => valor.u);

                this.data[0].x = DATA_X;
                this.data[0].y = DATA_Y;
                this.data[0].error_y.array = DATA_E;
            }
        },


    }
</script>


