<script setup>
import { Link } from "@inertiajs/vue3";

defineProps({
    href: {
        type: String,
        default: null,
    },
});
</script>
<template>
    <Link
        :href="href"
        class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-widest text-black uppercase transition duration-150 ease-in-out bg-white border-2 rounded-md hover:bg-gray-100 focus:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 active:bg-gray-200"
    >
        <slot />
    </Link>
</template>
