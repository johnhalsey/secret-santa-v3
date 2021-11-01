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

                <add-rules :group="group"></add-rules>

            </div>

            <div class="w-full md:w-1/2 lg:w-3/4 p-6 pr-0">
                <table-tool>
                    <tr v-for="user in group.members">
                        <td>
                            <span class="text-gray-600">{{ user.name }}</span>
                        </td>
                        <td>
                            <span class="text-gray-600">{{ user.email }}</span>
                        </td>
                        <td class="text-right">
                            <button @click="removeUser(user)">
                                <i class="fas fa-user-times text-gray-500"></i>
                            </button>
                        </td>
                    </tr>
                </table-tool>

                <group-exceptions :rules="group.exceptions"></group-exceptions>

            </div>
        </div>
    </container>
</template>

<script>

import JetLabel from '../../Jetstream/Label'
import JetButton from "../../Jetstream/Button"
import JetInput from "../../Jetstream/Input"
import JetSelect from "../../Jetstream/Select"
import TableTool from '../../Tools/Table'
import {Inertia} from "@inertiajs/inertia"

import AddRules from "../../PageComponents/Groups/AddRules"
import GroupExceptions from "../../PageComponents/Groups/GroupExceptions"

export default {
    name: "ShowGroupPage",
    props: ['group'],

    components: {
        JetLabel,
        JetButton,
        JetInput,
        TableTool,
        JetSelect,
        AddRules,
        GroupExceptions
    },

    data () {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
            }),
        }
    },

    methods: {
        addUser () {
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
