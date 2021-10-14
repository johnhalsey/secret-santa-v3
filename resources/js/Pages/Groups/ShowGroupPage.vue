<template>
    <container>
        <h3>{{group.name}}</h3>
        <div class="md:flex">
            <div class="w-full md:w-1/2 lg:w-1/4">
                <card>
                    <form @submit.prevent="addUser">
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

                <table>
                    <tr v-for="user in group.members">
                        <td>
                            {{user.user.name}}
                        </td>
                        <td>
                            {{user.user.email}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </container>
</template>

<script>

import JetLabel from '../../Jetstream/Label'
import JetButton from "../../Jetstream/Button"
import JetInput from "../../Jetstream/Input"


export default {
    name: "ShowGroupPage",
    props: ['group'],

    components: {
        JetLabel,
        JetButton,
        JetInput
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
            this.form
                .post(this.route('api.group.users.store', {group: this.group.id}), {
                    onSuccess: () => this.resetAddUserForm()
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
