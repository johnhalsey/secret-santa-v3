<template>
    <container>
        <div class="flex justify-between">
            <h3>{{ group.name }}</h3>
            <div>
                <flash-message v-if="messages.drawn.show"
                               class="mr-3">
                    Congratulations, your group has been drawn!
                </flash-message>
                <draw-group :group="group"
                            @drawn="groupDrawn"
                ></draw-group>
            </div>
        </div>

        <div class="md:flex">

            <div class="w-full md:w-1/2 lg:w-1/4">
                <add-members :group="group"></add-members>
                <add-rules :group="group"></add-rules>
            </div>

            <div class="w-full md:w-1/2 lg:w-3/4 mt-6 md:mt-0 md:p-6 md:pr-0">
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
import DrawGroup from "../../PageComponents/Groups/DrawGroup"
import FlashMessage from "@/PageComponents/Misc/FlashMessage"

export default {
    name: "ShowGroupPage",
    props: ['group'],

    components: {
        AddMembers,
        AddRules,
        GroupExceptions,
        GroupMembers,
        DrawGroup,
        FlashMessage
    },

    data () {
        return {
            messages: {
                drawn: {
                    show: false
                }
            }
        }
    },

    methods: {
        groupDrawn () {
            this.messages.drawn.show = true
            let vm = this
            setTimeout(function () {
                vm.messages.drawn.show = false
            }, 3000)
        }
    }
}
</script>
