<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <h3>Procedimiento - PCD-04</h3>
                <div class="d-flex">
                    <button class="btn btn-outline-primary mr-3"><i class="fas fa-plus"></i> Patron</button>
                    <button class="btn btn-outline-danger"><i class="fas fa-minus text-danger"></i> Patron</button>
                </div>
            </div>
        </div>

        <div class="mt-8 row border-primary border-bottom pb-8">
            <div class="p-2 mb-8 text-center col-12 bg-secondary position-relative">
                <h4 class="font-bold w-100">Patron</h4>
                <div class="position-absolute" style="top: 11px; right: 14px">
                    <span class="mr-3 hover-btn"><i class="fas fa-plus text-primary"></i></span>
                    <span class="hover-btn"><i class="fas fa-minus text-danger"></i></span>
                </div>
            </div>

            <div class="col-12 d-flex mb-6 align-items-center">
                <span class="title mr-10">Patron</span>
                <select name="" id="" class="form-control"></select>
            </div>


            <div class="col-12 d-flex align-items-center">
                <span class="title mr-3">Rango</span>

                <div class="d-flex align-items-center">
                    <span class="mr-3">de</span>
                    <input class="form-control mr-3">
                    <input class="form-control">
                </div>

                <div class="d-flex align-items-center">
                    <span class="mx-3">a</span>
                    <input class="form-control mr-3">
                    <input class="form-control">
                </div>

                <div class="d-flex align-items-center">
                    <span class="mx-3 title">cmc</span>
                    <input class="form-control mr-3">
                    <input class="form-control">
                </div>
            </div>
        </div>

        <div class="mt-8 row border-primary border-bottom pb-8">
            <div class="p-2 mb-8 text-center col-12 bg-secondary position-relative">
                <h4 class="font-bold w-100">Patron</h4>
                <div class="position-absolute" style="top: 11px; right: 14px">
                    <span class="mr-3 hover-btn"><i class="fas fa-plus text-primary"></i></span>
                    <span class="hover-btn"><i class="fas fa-minus text-danger"></i></span>
                </div>
            </div>

            <div class="col-12 d-flex mb-6 align-items-center">
                <span class="title mr-10">Patron</span>
                <select name="" id="" class="form-control"></select>
            </div>


            <div class="col-12 d-flex align-items-center">
                <span class="title mr-3">Rango</span>

                <div class="d-flex align-items-center">
                    <span class="mr-3">de</span>
                    <input class="form-control mr-3">
                    <input class="form-control">
                </div>

                <div class="d-flex align-items-center">
                    <span class="mx-3">a</span>
                    <input class="form-control mr-3">
                    <input class="form-control">
                </div>

                <div class="d-flex align-items-center">
                    <span class="mx-3 title">cmc</span>
                    <input class="form-control mr-3">
                    <input class="form-control">
                </div>
            </div>
        </div>

        <div class="row mt-8">
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form>
</template>

<script>
    export default {

    }
</script>

<style lang="scss">
    .title{font-size: 18px; font-weight: 600;}
</style>
