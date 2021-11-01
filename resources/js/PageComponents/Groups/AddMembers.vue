<template>
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
</template>

<script>

import JetLabel from '../../Jetstream/Label'
import JetButton from "../../Jetstream/Button"
import JetInput from "../../Jetstream/Input"

export default {
    name: "AddMembers",
    components: {
        JetLabel,
        JetButton,
        JetInput
    },

    props: {
        group: Object
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
        resetAddUserForm () {
            this.form.reset('name')
            this.form.reset('email')
        }
    },
}
</script>

<style scoped>

</style>
