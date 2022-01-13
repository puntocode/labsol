<template>
    <div class="card-body pt-3">
        <form class="mb-5" autocomplete="off" @submit.prevent="submit">

            <div class="row align-items-end">
                <div class="col-12">
                    <div class="form-group">
                        <label>Instrumento <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="form.name">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-5 row">
                <a :href="rutas.index" class="btn btn-secondary mr-2" title="Volver a listado">Volver</a>
                <button type="submit" class="btn btn-primary" :disabled="form.name.trim() === ''" title="Completa los campos obligatorios">{{ textoBtn }}</button>
            </div>

        </form>

    </div>
</template>

<script>
    export default {
        props: ['instrumento'],
        data() {
            return {
                rutas: window.routes,
                form: {id: 0, name: ''}
            }
        },

        created () {
            if(this.instrumento !== null) this.form = this.instrumento;
        },

        computed: {
            textoBtn() {
                return this.form.id === 0 ? 'Crear' : 'Actualizar';
            }
        },

        methods: {
            async submit() {
                try{
                    let res = null;
                    if(this.form.id === 0) res = await axios.post(this.rutas.store, this.form);
                    else res = await axios.put(`${this.rutas.index}/${this.form.id}`, this.form);

                    let mensaje = this.form.id === 0 ? 'Creado' : 'Actualizado';

                    this.$swal('Ok', `El instrumento se ha ${mensaje}`, 'success');

                }catch(error){
                    this.$swal.fire('Error', 'Ocurrio un error inesperado', 'error');
                }
            }
        },
    }
</script>
