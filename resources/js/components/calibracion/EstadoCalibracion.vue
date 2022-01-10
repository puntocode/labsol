<template>
    <div class="col-md-6 mx-auto">
        <form @submit.prevent="submit" v-if="estado.id == 3">
            <div class="form-group text-center">
                <input class="checkbox-tools aceptar" type="radio" value="4" id="accept" v-model="form.expediente_estado_id">
                <label class="for-checkbox-tools" for="accept">
                    <span class="icon-success-icon"></span>
                </label>

                <input class="checkbox-tools corregir" type="radio" value="8" id="correct" v-model="form.expediente_estado_id">
                <label class="for-checkbox-tools" for="correct" title="Se postergó la calibración para una revisión">
                    <span class="icon-correct-icon"></span>
                </label>

                <input class="checkbox-tools rechazar" type="radio" value="9" id="decline" v-model="form.expediente_estado_id">
                <label class="for-checkbox-tools" for="decline" title="Se devuelve a laboratorio para una nueva calibración">
                    <span class="icon-cancel-icon"></span>
                </label>

                <input class="checkbox-tools anular" type="radio" value="6" id="cancel" v-model="form.expediente_estado_id">
                <label class="for-checkbox-tools" for="cancel" title="No se realizará/terminará la calibración">
                    <span class="icon-null-icon"></span>
                </label>
            </div>

            <div class="form-group mt-6"  v-if="comentario">
                <label for="">Especificar Motivos <span class="text-danger">*</span></label>
                <textarea cols="30" rows="3" v-model="form.estado_comentario" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block" :disabled="form.expediente_estado_id === 0">Guardar</button>
        </form>

        <div v-else class="alert" :class="`alert-${estado.color}`" role="alert">
            <i class="mr-2 text-white fas" :class="estado.icon"></i>
            La calibracion ha sido <span class="text-capitalize" v-text="estado.name"></span>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['expediente_id', 'estado'],
        data() {
            return {
                form: {
                    expediente_id: this.expediente_id,
                    expediente_estado_id: 0,
                    estado_comentario: '',
                    autorizado_id: window.user
                },
                rutas: window.routes,
            }
        },

        methods: {
            submit() {
                if(this.form.expediente_estado_id != 4 && this.form.estado_comentario.trim() === ''){
                    this.$swal.fire('Error', 'Por favor completa el campo obligatorio', 'error');
                    return
                }

                axios.put(this.rutas.updateEstado, this.form)
                    .then(response =>{
                        if(response.status == 200) this.alertSuccess();
                    })
                    .catch(error => this.$swal.fire('Error', 'Error al guardar', 'error'));
            },
            alertSuccess(){
                this.$swal.fire('Actualizado', 'El expediente ha sido actualizado', 'success')
                    .then(response => location.reload())
            }
        },

        computed: {
            comentario() {
                return this.form.expediente_estado_id != 4 && this.form.expediente_estado_id != 0;
            },

        },
    }
</script>

<style lang="scss" scoped>


.checkbox:checked~.background-color {
    background-color: white;
}

[type="checkbox"]:checked,
[type="checkbox"]:not(:checked),
[type="radio"]:checked,
[type="radio"]:not(:checked) {
    position: absolute;
    left: -9999px;
    width: 0;
    height: 0;
    visibility: hidden;
}

.checkbox:checked+label,
.checkbox:not(:checked)+label {
    position: relative;
    width: 70px;
    display: inline-block;
    padding: 0;
    margin: 0 auto;
    text-align: center;
    margin: 17px 0;
    margin-top: 100px;
    height: 6px;
    border-radius: 4px;
    //background-image: linear-gradient(298deg, var(--red), var(--yellow));
    z-index: 100 !important;
}

.checkbox-tools:checked+label,
.checkbox-tools:not(:checked)+label {
    position: relative;
    display: inline-block;
    //padding: 20px;
    width: 100px;
    height: 100px;
    font-size: 14px;
    line-height: 15px;
    letter-spacing: 1px;
    margin: 0 auto;
    margin-left: 5px;
    margin-right: 5px;
    margin-bottom: 10px;
    text-align: center;
    border-radius: 4px;
    overflow: hidden;
    cursor: pointer;
    text-transform: uppercase;
    color: #353746;
    -webkit-transition: all 300ms linear;
    transition: all 300ms linear;
    span {
        font-size: 95px;
    }
}

.checkbox-tools:not(:checked)+label {
    background-color: #ecedf3;
    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
}

.checkbox-tools:checked+label {
    background-color: #033479;
    color: white;
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

.aceptar:checked+label {
    background-color: #2EC034;
}

.rechazar:checked+label {
    background-color: #F64E60;
}

.corregir:checked+label {
    background-color: #8950FC;
}

.anular:checked+label {
    background-color: #FFA800;
}

.checkbox-tools:not(:checked)+label:hover {
    box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}

@media (max-width: 600px) {
    .checkbox-tools:checked+label,
    .checkbox-tools:not(:checked)+label {
        width: 70px;
        height: 70px;
        span {
            font-size: 65px;
        }
    }
}
</style>
