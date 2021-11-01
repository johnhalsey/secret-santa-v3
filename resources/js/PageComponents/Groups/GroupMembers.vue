<template>
    <table-tool>
        <tr v-for="user in members">
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
</template>

<script>
import TableTool from '../../Tools/Table'
import {Inertia} from "@inertiajs/inertia"

export default {
    name: "GroupMembers",
    components: {
        TableTool
    },
    props: {
        members: Array
    },
    methods: {
        removeUser (user) {
            axios.delete(this.route('api.group.members.destroy', {group: user.group_id, member: user.id}))
                .then(() => {
                    Inertia.reload()
                })
        },
    }
}
</script>

<style scoped>

</style>
