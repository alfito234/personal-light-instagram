<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    user: {
        type: Object,
        required: true,
    },
    post: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Post" />

    <component :is="$page.props.auth.user ? AuthenticatedLayout : GuestLayout">
        <div class="py-12">
            <div class="grid max-w-5xl grid-cols-2 mx-auto bg-white">
                <div class="grid items-center bg-black aspect-square">
                    <img :src="`/storage/${post.image}`" alt="" />
                </div>
                <div class="flex flex-col">
                    <Link
                        :href="
                            route('profile.show', {
                                id: user.id,
                            })
                        "
                        class="flex items-center gap-3 p-5 border-b shadow-sm"
                    >
                        <div class="w-8 h-8">
                            <img
                                class="w-[180px] aspect-square object-cover rounded-full"
                                src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt="Profile Picture"
                            />
                        </div>
                        <h2 class="font-bold">{{ user.username }}</h2>
                    </Link>
                    <div class="p-5">
                        <p>
                            <strong>{{ user.username }}</strong>
                            {{ post.caption }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </component>
</template>
