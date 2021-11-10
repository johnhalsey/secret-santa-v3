<template>
    <container>
        <h3 class="mb-3">Add your new secret groups here</h3>
        <div class="md:flex">
            <div class="w-full md:w-1/2 lg:w-1/4">
                <card>
                    <form @submit.prevent="submit">
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
                </card>
            </div>

            <div class="w-full md:w-1/2 lg:w-3/4 p-6">

                <table-tool>
                    <tr v-for="group in groups">
                        <td>
                            <Link :href="route('group.show', {'group': group.id})"
                                  class="text-red-500 hover:text-red-900">
                                {{group.name}}
                            </Link>
                        </td>
                        <td class="text-gray-600">
                            <span v-if="group.drawn_at">Last drawn on {{group.drawn_at}}</span>
                        </td>
                    </tr>
                </table-tool>
            </div>
        </div>

    </container>
</template>

<script>

import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import { Link } from '@inertiajs/inertia-vue3';
import TableTool from "../Tools/Table"

export default {
    name: "Groups",
    components: {
        JetInput,
        JetLabel,
        JetButton,
        Link,
        TableTool
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


