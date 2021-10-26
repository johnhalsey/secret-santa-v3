<template>
    <container>
        <h3>{{ group.name }}</h3>
        <div class="md:flex">
            <div class="w-full md:w-1/2 lg:w-1/4">
                <card>
                    <h4>Step 1 - Add Users</h4>
                    <form @submit.prevent="addUser" class="mt-3">
                        <div>
                            <jet-label for="name" value="User name"/>
                            <jet-input id="name"
                                       type="text"
                                       class="mt-1 block w-full"
                                       v-model="form.name"
                                       required
                                       ref="user-name"
                                       autofocus/>
                        </div>
                        <div>
                            <jet-label for="email" value="User email"/>
                            <jet-input id="email"
                                       type="email"
                                       class="mt-1 block w-full"
                                       v-model="form.email"
                                       required
                                       ref="user-email"/>
                        </div>
                        <div class="mt-3">
                            <jet-button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Add User
                            </jet-button>
                        </div>
                    </form>
                </card>

                <card class="">
                    <h4>Step 2 - Add Rules</h4>
                    <form @submit.prevent="addUser" class="mt-3">
                        <div>
                            <jet-label for="name" value="User name"/>
                            <jet-input id="name"
                                       type="text"
                                       class="mt-1 block w-full"
                                       v-model="form.name"
                                       required
                                       ref="user-name"
                                       autofocus/>
                        </div>
                        <div>
                            <jet-label for="email" value="User email"/>
                            <jet-input id="email"
                                       type="email"
                                       class="mt-1 block w-full"
                                       v-model="form.email"
                                       required
                                       ref="user-email"/>
                        </div>
                        <div class="mt-3">
                            <jet-button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Add User
                            </jet-button>
                        </div>
                    </form>
                </card>
            </div>

            <div class="w-full md:w-1/2 lg:w-3/4 p-6">

                <table-tool>
                    <tr v-for="user in group.members">
                        <td>
                            <span class="text-gray-600">{{ user.name }}</span>
                        </td>
                        <td>
                            <span class="text-gray-600">{{ user.email }}</span>
                        </td>
                        <td>
                            <button @click="removeUser(user)">
                                <i class="fas fa-user-times text-gray-500"></i>
                            </button>
                        </td>
                    </tr>
                </table-tool>
            </div>
        </div>
    </container>
</template>

<script>

import JetLabel from '../../Jetstream/Label'
import JetButton from "../../Jetstream/Button"
import JetInput from "../../Jetstream/Input"
import TableTool from '../../Tools/Table'
import {Inertia} from "@inertiajs/inertia"

export default {
    name: "ShowGroupPage",
    props: ['group'],

    components: {
        JetLabel,
        JetButton,
        JetInput,
        TableTool
    },

    data () {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
            })
        }
    },

    methods: {
        addUser () {
            console.log(this.group.id)
            this.form
                .post(this.route('api.group.members.store', this.group.id), {
                    onSuccess: () => this.resetAddUserForm()
                })
        },
        removeUser (user) {
            axios.delete(this.route('api.group.members.destroy', {group: this.group.id, member: user.id}))
                .then(() => {
                    Inertia.reload()
                })
        },
        resetAddUserForm () {
            this.form.reset('name')
            this.form.reset('email')
        }
    },
}
</script>

<style scoped>

</style>
