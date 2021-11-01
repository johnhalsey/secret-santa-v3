<template>
    <jet-button @click.prevent="drawGroup">Draw!</jet-button>
</template>

<script>
import JetButton from "../../Jetstream/Button"

export default {
    name: "DrawGroup",
    components: {
        JetButton
    },

    props: {
        group: Object
    },

    methods: {
        drawGroup () {
            axios.post(this.route('api.group.draw', this.group.id), {

            })
        }
    }
}
</script>
