<template>
    <jet-button @click.prevent="drawGroup">
        <span v-if="loading"><i class="fas fa-spinner fa-pulse"></i></span>
        <span v-else>{{buttonText}}</span>
    </jet-button>
</template>

<script>
import JetButton from "../../Jetstream/Button"
import {Inertia} from "@inertiajs/inertia"

export default {
    name: "DrawGroup",
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

    computed: {
        buttonText () {
            return this.group.drawn_at ? 'Re Draw!' : 'Draw!'
        }
    },

    methods: {
        drawGroup () {
            this.loading = true
            axios.post(this.route('api.group.draw', this.group.id))
                .then(() => {
                    Inertia.reload({only: ['group']})
                    this.loading = false
                    this.$emit('drawn')
                })
        }
    }
}
</script>
