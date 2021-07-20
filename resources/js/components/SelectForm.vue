<template>
     <div class="form-group">
        <label>{{label}} <span class="text-danger">*</span></label>
        <select class="form-control text-capitalize" v-model="selected">
            <option value="0" disabled>{{ texto }}</option>
            <option v-for="(attr,index) in attributes" :key="index" :value="attr.id">{{ attr.name }}</option>
        </select>
    </div>
</template>

<script>
    export default {
        props: ["label", "url", "value", "texto"],
        data() {
            return {
                attributes: {},
            }
        },
        created(){
            this.fetch()

        },
        methods:{
            fetch(){
                axios.get(this.url).then( response => this.attributes = response.data)
            },
        },
        computed:{
            selected:{
                get() {return this.value},
                set(v) {this.$emit('input', v)}
            }
        },

    }
</script>

<style lang="scss" scoped>

</style>
