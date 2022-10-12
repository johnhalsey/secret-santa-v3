<template>
    <jet-button @click.prevent="reDrawGroup">
        <span v-if="loading"><i class="fas fa-spinner fa-pulse"></i></span>
        <span v-else>Re Draw!</span>
    </jet-button>
</template>

<script>

import JetButton from "../../Jetstream/Button"
import {Inertia} from "@inertiajs/inertia"

export default {
    name: "ReDrawGroup",
    components: {
        JetButton
    },

    props: {
        group: Object
    },

    data () {
        return {
            loading: false
        }
    },

    methods: {
        reDrawGroup () {
            this.loading = true
            axios.post(this.route('api.group.redraw', this.group.id))
                .then(() => {
                    Inertia.reload({only: ['group']})
                    this.loading = false
                    this.$emit('drawn')
                })
        }
    }
}
</script>

<style scoped>

</style>
