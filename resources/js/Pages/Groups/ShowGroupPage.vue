<template>
    <container>
        <h3>{{ group.name }}</h3>
        <div class="md:flex">

            <div class="w-full md:w-1/2 lg:w-1/4">
                <add-members :group="group"></add-members>
                <add-rules :group="group"></add-rules>
            </div>

            <div class="w-full md:w-1/2 lg:w-3/4 p-6 pr-0">
                <group-members :members="group.members"></group-members>
                <group-exceptions :rules="group.exceptions"></group-exceptions>
            </div>

        </div>
    </container>
</template>

<script>

import AddMembers from "../../PageComponents/Groups/AddMembers"
import AddRules from "../../PageComponents/Groups/AddRules"
import GroupExceptions from "../../PageComponents/Groups/GroupExceptions"
import GroupMembers from "../../PageComponents/Groups/GroupMembers"

export default {
    name: "ShowGroupPage",
    props: ['group'],

    components: {
        AddMembers,
        AddRules,
        GroupExceptions,
        GroupMembers
    }
}
</script>
