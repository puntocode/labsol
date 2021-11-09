<template>
    <section class="mt-5">
        <!-- <div class="row mb-10 noPrint">
            <div class="col-12">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="codigo">Codigo</label>
                            <input class="form-control" v-model="codigo">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="revision">Revisión</label>
                            <input type="number" class="form-control" v-model="revision">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="vigencia">Vigencia</label>
                            <input type="date" class="form-control" v-model="vigencia">
                        </div>
                    </div>
                </form>
            </div>
        </div>-->

        <div class="row justify-content-center w-100">
            <div class="col-md-3 py-4 mx-0">
            <img :src="logo" alt="logo-labsol" class="img-fluid">
            </div>
            <div class="col-md-3 mx-1 px-0 d-flex justify-content-center align-items-center bg-light">
                <span class="text-center font-bold w-100">RECEPCIÓN DE ITEMS DE CALIBRACIÓN</span>
            </div>
            <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                <span class="text-center py-2 bg-light w-100 font-bold">Código</span>
                <span class="text-center py-2 my-2 bg-light w-100 font-bold">Revision</span>
                <span class="text-center py-2 bg-light w-100 font-bold">Vigencia</span>
            </div>
            <div class="col-md-2 px-0 mx-1 d-flex flex-column justify-content-center align-items-center">
                <span id="codigo" class="py-2 px-4 bg-light w-100" v-text="codigo"></span>
                <span id="revision" class="py-2 px-4 my-2 bg-light w-100" v-text="revision"></span>
                <span id="vigencia" class="py-2 px-4 bg-light w-100" v-text="vigenciaTxt"></span>
            </div>
        </div>
    </section>
</template>

<script>
    import moment from 'moment';

    export default {
        props: ['logo'],
        data() {
            return {
                codigo: 'LS-FOR-047',
                revision: '1',
                vigencia: moment().format('YYYY/MM/DD'),
            }
        },
        computed: {
            vigenciaTxt() {
                let fecha = moment(this.vigencia, 'YYYY/MM/DD');
                return String(fecha.format("DD/MM/YYYY"))
            }
        },
    }
</script>
