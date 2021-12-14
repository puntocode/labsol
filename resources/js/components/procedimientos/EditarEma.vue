<template>
    <div class="col-2">
        <i
            class="las la-edit text-primary pointer"
            data-toggle="modal"
            data-target="#modal-ema"
            title="Actualizar EMA"
            style="font-size: 20px">
        </i>

        <div class="modal fade" id="modal-ema" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary rounded-0">
                        <h5 class="text-white modal-title" id="modal-label">Actualizar Equipos de Medición Ambiental</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form class="mb-5" autocomplete="off" @submit.prevent="submit">
                        <div class="modal-body">
                            <div class="mb-6 row">
                                <div class="mx-auto col-10">
                                    <label for="date">Patrones</label>
                                    <SelectMultiple v-model="patrones" :options="selectPatrones" class="mb-3" />
                                    <small class="text-danger">Obs: al actualizar la lista ya se modifica en todos los procedimientos!</small>
                                </div>
                            </div>
                        </div>
                        <div class="border-0 pt-0 modal-footer justify-content-center">
                            <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal" id="btn-cancelar">Cancelar</button>
                            <button type="button" class="btn btn-primary font-weight-bold" @click="submit" :disabled="patrones.length === 0">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SelectMultiple from 'v-select2-multiple-component';

    export default {
        components: { SelectMultiple },
        props: ['data'],
        data() {
            return {
                patrones: this.data.code,
                selectPatrones: [],
                rutas: window.routes,
            }
        },
        created () {
            this.cargarSelect();
        },
        methods: {
            async cargarSelect(){
                let res = await axios.get(this.rutas.getPatron);
                const patrones = await res.data;

                res = await axios.get(this.rutas.getEquipos);
                const equipos = await res.data;

                const patronesEquipos = [...patrones, ...equipos];
                this.selectPatrones = patronesEquipos.map( patron => { return {id: patron.code, text: patron.code} });
            },
            submit() {
                axios.put(this.rutas.update, this.patrones)
                    .then(response => { if(response.status === 200) location.reload(); })
                    .catch(error => this.$swal.fire('Error', 'Error al actualizar', 'error'));
            }
        },
    }
</script>

