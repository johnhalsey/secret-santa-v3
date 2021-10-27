<template>
    <card class="">
        <h4>Step 2 - Add Rules</h4>
        <form @submit.prevent="submit" class="mt-3">
            <div>
                <jet-label for="user_a" value="This person"/>
                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        v-model="form.user_a_id"
                        ref="select">
                    <option :value="null">Select</option>
                    <option v-for="(member, index) in selectableMembers"
                            :key="'member-' + index"
                            :value="member.value">{{member.label}}
                    </option>
                </select>
            </div>
            <div>
                <jet-label for="user_b" value="Cannot choose"/>
                <select class="w-full border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        v-model="form.user_b_id"
                        ref="select">
                    <option :value="null">Select</option>
                    <option v-for="(member, index) in selectableMembers"
                            :key="'member-' + index"
                            :value="member.value">{{member.label}}
                    </option>
                </select>

            </div>
            <div class="mt-3">
                <jet-button class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Add Rule
                </jet-button>
            </div>
        </form>
    </card>
</template>

<script>

import JetLabel from "../../Jetstream/Label"
import JetButton from "../../Jetstream/Button"
import JetSelect from "../../Jetstream/Select"

export default {
    name: "AddRules",

    components: {
        JetLabel,
        JetButton,
        JetSelect
    },

    props: {
        group: Object
    },

    data () {
        return {
            form: this.$inertia.form({
                user_a_id: null,
                user_b_id: null,
            }),
        }
    },

    computed: {
        selectableMembers () {
            let selectables = []
            for (let i = 0; i < this.group.members.length; i++) {
                selectables.push({
                    label: this.group.members[i].name,
                    value: this.group.members[i].id
                })
            }

            return selectables
        }
    },

    methods: {
        submit () {
            this.form
                .post(this.route('api.group.exceptions.store', {group: this.group.id}), {
                    onSuccess: () => this.resetForm(),
                })
        },
        resetForm() {
            this.form.reset('user_a_id')
            this.form.reset('user_b_id')
        }
    }

}
</script>

<style scoped>

</style>
