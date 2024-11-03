<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import TertiaryButton from "@/Components/TertiaryButton.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <nav class="flex items-center justify-between px-8 py-3 bg-white">
            <Link href="/">
                <ApplicationLogo class="w-56 h-10 text-gray-500 fill-current" />
            </Link>
            <div class="flex gap-5">
                <TertiaryButton :href="route('login')">Log in</TertiaryButton>
                <TertiaryButton :href="route('register')"
                    >Register</TertiaryButton
                >
            </div>
        </nav>

        <main>
            <slot />
        </main>
    </div>
</template>
