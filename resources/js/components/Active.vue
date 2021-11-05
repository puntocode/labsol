<template>
    <div class="badge text-white pointer" :class="colorEstado" @click="activar">{{ texto }}</div>
</template>

<script>
export default {
    props: ['estado', 'url'],
    data() {
        return {
            texto: this.estado
        }
    },
    computed:{
        colorEstado(){
            return this.texto === 'ACTIVO' ? 'bg-success' : 'bg-gray-600'
        }
    },
    methods: {
        activar() {
            axios.get(`${this.url}`)
                .then(respuesta => this.texto=respuesta.data)
                .catch(error => console.log(error))
        }
    },
}
</script>


