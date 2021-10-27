<template>
    <select class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
           v-model="selected"
           ref="select">
        <option v-for="(option, index) in options"
                :key="index + '-option'"
                :value="option">{{option}}
        </option>
    </select>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        props: ['options'],

        emits: ['input'],

        data () {
            return {
                selected: value
            }
        },

        watch: {
            selected: function () {
                this.$emit('input', this.selected)
            }
        },

        methods: {
            focus() {
                this.$refs.select.focus()
            },

        },
    })
</script>
