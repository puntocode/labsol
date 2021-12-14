<template>
   <div>
        <Plotly :data="data" :layout="layout" :display-mode-bar="false"></Plotly>
  </div>
</template>

<script>
    import { Plotly } from 'vue-plotly'

    export default {
        props: [ 'ejeX', 'ejeY', 'errorIncer'],
        components: { Plotly },
        data() {
            return {
                 data:[{
                    x: this.ejeX,
                    y: this.ejeY,
                    error_y: {
                        type: 'data',
                        array: this.errorIncer,
                        visible: true
                    },
                    type: 'scatter'
                }],
                layout:{ title: "Error + Incertidumbre" }
            }
        },
    }

</script>
