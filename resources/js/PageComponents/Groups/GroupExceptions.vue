<template>
    <table-tool class="mt-6">
        <tr v-for="rule in rules">
            <td>
                <span class="text-gray-600">{{ rule.member_name }} cannot choose {{rule.exception_name}}</span>
            </td>
            <td class="text-right">
                <button @click="removeRule(rule)">
                    <i class="far fa-trash-alt text-gray-500"></i>
                </button>
            </td>
        </tr>
    </table-tool>
</template>

<script>
import TableTool from '../../Tools/Table'
import {Inertia} from "@inertiajs/inertia"

export default {
    name: "GroupExceptions",
    components: {
        TableTool
    },
    props: {
        rules: Array
    },
    methods:{
        removeRule (rule) {
            axios.delete(this.route('api.group.exceptions.destroy', {group: rule.group_id, exception: rule.id}))
            .then(() => {
                Inertia.reload()
            })
        }
    }
}
</script>
