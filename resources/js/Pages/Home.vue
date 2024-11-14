<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    posts: {
        type: Array,
        required: true,
    },
});
</script>

<template>
    <Head title="Home" />

    <AuthenticatedLayout>
        <div class="pt-24">
            <div class="max-w-lg mx-auto">
                <div class="grid grid-cols-1 gap-5">
                    <div
                        v-for="post in posts"
                        :key="post.id"
                        class="border-b-2 aspect-square"
                    >
                        <Link
                            :href="
                                route('profile.show', {
                                    id: post.user.id,
                                })
                            "
                            class="flex items-center gap-3 p-4 border-b"
                        >
                            <div class="w-8 h-8">
                                <img
                                    class="w-[180px] aspect-square object-cover rounded-full"
                                    :src="
                                        '/storage/' +
                                        post.user.profile.profile_picture
                                    "
                                />
                            </div>
                            <h2 class="font-bold">{{ post.user.username }}</h2>
                        </Link>
                        <img
                            v-if="post.image"
                            :src="`/storage/${post.image}`"
                            alt="Post Image"
                            class="object-cover w-full aspect-auto"
                        />

                        <div class="flex gap-2 mt-2">
                            <h2 class="font-semibold">
                                {{ post.user.username }}
                            </h2>
                            <p class="font-normal">
                                {{ post.caption }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
