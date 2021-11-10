<template>
    <jet-button @click.prevent="reDrawGroup">Re Draw!</jet-button>
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

    methods: {
        reDrawGroup () {
            axios.post(this.route('api.group.redraw', this.group.id))
                .then(() => {
                    Inertia.reload({only: ['group']})
                })
        }
    }
}
</script>

<style scoped>

</style>
