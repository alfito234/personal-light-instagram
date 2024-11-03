<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import TertiaryButton from "@/Components/TertiaryButton.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
</script>

<template>
    <Head title="Welcome" />
    <div class="bg-gray-100">
        <div class="relative flex items-center justify-center min-h-screen">
            <div class="w-full max-w-2xl px-6 lg:max-w-4xl">
                <main class="grid grid-flow-col mt-6">
                    <img
                        class="object-cover rounded-lg w-80 aspect-[9/16]"
                        src="https://images.unsplash.com/photo-1535451801241-b5395e1d4a1b?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt=""
                    />
                    <div
                        class="grid justify-center h-full p-8 text-black bg-white rounded-lg max-w-7xl"
                    >
                        <header class="mx-auto mb-4">
                            <ApplicationLogo
                                class="h-20 text-black fill-current w-44"
                            />
                        </header>

                        <div class="mb-4 text-center">
                            <h1 class="text-3xl font-bold text-gray-800">
                                Welcome to Our Platform
                            </h1>
                            <p class="mt-2 text-gray-600">
                                Connect, explore, and grow with us.
                            </p>
                        </div>

                        <div
                            class="grid justify-center w-full gap-5 mt-6 text-center"
                        >
                            <TertiaryButton :href="route('login')"
                                >Log in</TertiaryButton
                            >
                            <span>or</span>
                            <TertiaryButton :href="route('register')"
                                >Register</TertiaryButton
                            >
                            <footer
                                class="mt-10 text-sm text-center text-gray-500"
                            >
                                <p>© 2024 Instagram. All rights reserved.</p>
                            </footer>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>
