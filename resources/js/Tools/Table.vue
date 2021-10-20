<template>
    <table class="w-full bg-white">
        <thead>
           <slot name="headers"></slot>
        </thead>
        <tbody>
            <slot></slot>
        </tbody>
    </table>
</template>

<script>
export default {
    name: "TableTool",
    props:{

    }
}
</script>

<style lang="postcss">

table tr td {
    @apply p-3 border-b;
}

</style>
