<template>
    <i class="la la-edit icon"></i>
    <!-- <i class="la la-edit icon" data-toggle="modal" data-target="#valorModal" @click="editar"></i> -->
</template>

<script>
    export default {
        props:['valor', 'index', 'tipo', 'global'],
        data() {
            return {
                editValue: { anterior: '', indice: '', tipo: '', global: 0 }
            }
        },
        methods: {
            editar() {
                this.editValue.tipo = this.tipo;
                this.editValue.indice = this.index;
                this.editValue.global = this.global;

                if(this.tipo === 'ip_valor') this.editValue.anterior = this.valor.ip_valor[this.index];
                else this.editValue.anterior = this.valor.iec_valor[this.index];

                this.$emit('update:valorEdit', this.editValue);
                this.$emit('update:lastEdit', this.valor);
            }
        },
    }
</script>


<style lang="scss" scoped>
    .icon {
        padding: 10px 5px;
        color: #009BDD;
        min-width: 50px;
        text-align: right;
        cursor: pointer;
    }
</style>
