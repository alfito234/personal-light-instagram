<script setup>
import SecondaryButton from "@/Components/SecondaryButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const currentUser = ref(props.user);

const editProfile = () => {
    console.log("Membuka modal Edit Profil");
    console.log(user.name);
};
const viewArchive = () => {
    console.log("Membuka Archive");
};
</script>

<template>
    <Head :title="user.name" />

    <component :is="$page.props.auth.user ? AuthenticatedLayout : GuestLayout">
        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="grid text-gray-900">
                        <div class="grid grid-cols-3 mb-20">
                            <div class="flex items-center justify-center">
                                <img
                                    class="w-[180px] aspect-square object-cover rounded-full"
                                    :src="user.profile.profile_picture?('/storage/'+user.profile.profile_picture):'/storage/profiles/default.jpg'"
                                    alt="Profile Picture"
                                />
                            </div>
                            <div
                                class="grid grid-flow-row col-span-2 gap-5 p-4 auto-rows-min"
                            >
                                <div class="flex items-end gap-4">
                                    <h3 class="text-xl font-bold">
                                        @{{ user.username }}
                                    </h3>
                                    <template
                                        v-if="
                                            $page.props.auth.user &&
                                            $page.props.auth.user.email ===
                                                user.email
                                        "
                                    >
                                        <Link
                                            :href="
                                                route('profile.edit', {
                                                    user: currentUser,
                                                })
                                            "
                                        >
                                            <SecondaryButton class="text-[10px]"
                                                >Edit Profile</SecondaryButton
                                            >
                                        </Link>
                                        <SecondaryButton
                                            class="text-[10px]"
                                            @click="viewArchive"
                                            >View Archive</SecondaryButton
                                        >
                                        <Link :href="route('post.create')">
                                            <SecondaryButton
                                                class="text-[10px] text-white hover:bg-pink-500 !bg-pink-600"
                                                >Add New Post</SecondaryButton
                                            ></Link
                                        >
                                    </template>
                                </div>
                                <div class="grid grid-cols-3">
                                    <div>
                                        <strong>{{ user.posts.length }}</strong>
                                        Posts
                                    </div>
                                    <div><strong>608</strong> Followers</div>
                                    <div><strong>1338</strong> Following</div>
                                </div>
                                <div class="grid grid-rows-3">
                                    <h4 class="text-lg font-semibold">
                                        {{ user?.name }}
                                    </h4>
                                    <p>
                                        {{ user?.profile?.description || "" }}
                                    </p>

                                    <a href="#">
                                        {{ user?.profile?.url || "" }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <Link
                                v-for="post in user.posts"
                                :key="post.id"
                                :href="
                                    route('post.show', {
                                        post: post.id,
                                    })
                                "
                            >
                                <img
                                    class="object-cover aspect-square"
                                    :src="`/storage/${post.image}`"
                                    alt="Post Image"
                                />
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </component>
</template>
