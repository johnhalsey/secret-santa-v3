<template>
    <container class="mt-5">

        <div class="md:flex">

            <div class="w-full md:w-1/2 lg:w-1/4 bg-green-300 p-6">
                <h2>Add a new Group here</h2>
                <form @submit.prevent="submit" class="mt-6">
                    <div>
                        <jet-label for="name" value="Group Name"/>
                        <jet-input id="name"
                                   type="text"
                                   class="mt-1 block w-full"
                                   v-model="form.name"
                                   required
                                   ref="group-name"
                                   autofocus/>
                    </div>

                    <div class="mt-3">
                        <jet-button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Add
                        </jet-button>
                    </div>
                </form>
            </div>

            <div class="w-full md:w-1/2 lg:w-3/4 p-6">

                <table>
                    <tr v-for="group in groups">
                        <td>
                            {{group.name}}
                        </td>
                    </tr>
                </table>
            </div>

        </div>

    </container>
</template>

<script>

import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import {Inertia} from "@inertiajs/inertia"

export default {
    name: "Groups",
    components: {
        JetInput,
        JetLabel,
        JetButton
    },
    props: ['groups'],
    data () {
        return {
            form: this.$inertia.form({
                name: '',
            })
        }
    },
    methods: {
        submit () {
            this.form
                .post(this.route('api.groups.store'), {
                    onSuccess: () => this.form.reset('name'),
                })
        }
    }
}
</script>


