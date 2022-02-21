<template>
    <i class="la la-edit icon" data-toggle="modal" data-target="#valorModal" @click="editar()"></i>
</template>

<script>
    export default {
        props:['fila', 'tipo', 'columna', 'valor', 'valor_id'],
        data() {
            return {
                editValue: { anteriores: '', fila: '', columna:'', tipo: '', valor_id: 0 }
            }
        },
        methods: {
            editar(){
                this.editValue.tipo = this.tipo;
                this.editValue.fila = this.fila;
                this.editValue.columna = this.columna;
                this.editValue.valor_id = this.valor_id;
                // this.editValue.valoresForm = this.valor;

                if(this.tipo === 'ip_valor') this.editValue.anteriores = this.valor.ip_valor[this.columna];
                else this.editValue.anteriores = this.valor.iec_valor[this.columna];

                this.$emit('update:valorEdit', this.editValue);
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
