<template>
    <div class="d-flex align-items-stretch" style="min-height: 430px">
        <div class="mr-2 flex-fill w-100">
            <div class="kanban-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="p-0 m-0"><i class="fa fa-user"></i> Técnicos Disponibles</h3>
                    <span v-text="disponibles.length"></span>
                </div>
            </div>
            <draggable class="list-group kanban-col" :list="disponibles" group="tasks">
                <div class="list-group-item mt-4 shadow-sm rounded" v-for="item in disponibles" :key="item.id">
                    <div class="d-flex">
                        <div class="symbol symbol-40 symbol-light-primary flex-shrink-0 mr-2">
                            <span class="symbol-label font-weight-bold text-uppercase">{{ item.abbreviation }}</span>
                        </div>
                        <div class="form-group mb-0">
                            <p class="font-weight-bold text-capitalize p-0 m-0">{{ item.fullname }}</p>
                            <small class="text-success">Personal Laboratorio</small>
                        </div>
                    </div>
                </div>
            </draggable>
        </div>

        <div class="ml-2 flex-fill w-100">
            <div class="kanban-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="p-0 m-0"><i class="fa fa-user"></i> Técnicos Asignados</h3>
                    <span v-text="asignados.length"></span>
                </div>
            </div>
            <draggable class="list-group kanban-col" :list="asignados" group="tasks" >
                <div class="list-group-item mt-4 shadow-sm rounded" v-for="item in asignados" :key="item.id">
                    <div class="d-flex">
                       <div class="symbol symbol-40 symbol-light-primary flex-shrink-0 mr-2">
                            <span class="symbol-label font-weight-bold text-uppercase">{{ item.abbreviation }}</span>
                        </div>
                        <div class="form-group mb-0">
                            <p class="font-weight-bold text-capitalize p-0 m-0">{{ item.fullname }}</p>
                            <small class="text-success">Personal Laboratorio</small>
                        </div>
                    </div>
                </div>
            </draggable>
        </div>
    </div>
</template>

<script>
    import draggable from 'vuedraggable'
    export default {
        components: { draggable },
        props: ['asignados', 'disponibles'],
        // watch: {
        //     asignado() {
        //         if(this.asignado.length === 0)  this.$emit('update:value', 0)
        //         else this.$emit('update:value', this.asignado[0].id)
        //     },
        // },
        //  methods: {
        //     moveCard() {
        //         if (this.asignado.length >= 1) return false;
        //     }
        // },
    }
</script>


<style lang="scss" scoped>
    $secondary: #009BDE;
    .kanban-header{padding: 15px; border-radius: 8px; background-color: #1BC5BD; color: #fff;
        h3{ font-size: 16px;
            i{font-size: 15px; color: #fff;}
        }
    }
    .kanban-col{ height: 100%; padding: 20px; background-color: #F1F2F6; margin-top: 10px; border-radius: 8px; max-height: 350px; overflow: scroll; overflow-x: hidden;
        .list-group-item{cursor: move;}
    }
</style>
