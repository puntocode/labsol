<template>
    <div class="container-fluid">
        <div class="row mb-6">
            <div class="col-12 d-flex justify-content-between align-items-start">
                <h3 class="card-label mb-8">Expedientes <small class="font-weight-lighter">| Asignar técnicos</small></h3>
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalTecnicos"><i class="fas fa-users pr-2"></i>Asignar Técnicos</button>
            </div>
        </div>

        <ExpedienteCard />
    </div>
</template>

<script>
    import ExpedienteCard from './ExpedienteCard'
    export default {
        components: { ExpedienteCard, },
    }
</script>
