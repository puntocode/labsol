<template>
    <div class="row">
        <div class="col-12 mb-6" v-for="(codigo, i) in patronCodigos" :key="i">
            <table class="table table-sm table-bordered table-hover">
                <thead>
                    <tr class="cabecera">
                        <th>Vista</th>
                        <th scope="col">Patron</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-toggle="collapse" :data-target="`#table-${codigo}`" class="accordion-toggle">
                        <td class="w-5"><a href="javascript:void(0);"><i class="fas fa-list text-primary"></i></a></td>
                        <td>{{ codigo }}</td>
                    </tr>

                    <tr>
                        <td colspan="12" class="hiddenRow">
                            <div class="accordian-body collapse" :id="`table-${codigo}`">
                                <cmc-table :cmc-table="rangos[i]" :show="false"></cmc-table>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import CmcTable from './CmcTable';


    export default {
        components: { CmcTable },
        props: ['cmcs', 'patrones'],

        data() {
            return {
                patronCodigos: [],
                rangos: []
            }
        },

        created () {
            this.fetch();
        },


        methods: {
            fetch() {
                this.patrones.forEach(patron => {
                    patron.code.forEach(codigo => this.patronCodigos.push(codigo) );
                });

                this.patronCodigos.forEach(codigo => {
                    let cmc = this.cmcs.filter(cmc => cmc.patron_code === codigo);
                    this.rangos.push(cmc);
                })
            }
        },
    }
</script>

<style lang="scss" scoped>
    .cabecera{
        th{padding-top: 5px !important; padding-bottom: 5px !important; background-color: #ececec;}
    }
    .w-5{width: 65px; max-width: 70px;}
</style>
