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
                                    src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Profile Picture"
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
                        <!-- <video v-if="post.video" controls class="w-full h-64">
                            <source :src="post.video" type="video/mp4" />
                            Your browser does not support the video tag.
                        </video> -->
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
            <!-- <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden sm:rounded-lg">
                    <div class="grid text-gray-900">
                        <div class="grid grid-cols-3 mb-20">
                            <div class="flex items-center justify-center">
                                <img
                                    class="w-[180px] aspect-square object-cover rounded-full"
                                    src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    alt="Profile Picture"
                                />
                            </div>
                            <div class="grid col-span-2 grid-rows-5">
                                <h3 class="text-xl font-bold">
                                    @{{ $page.props.auth.user.username }}
                                </h3>
                                <div class="grid grid-cols-3">
                                    <div><strong>17</strong> Posts</div>
                                    <div><strong>608</strong> Followers</div>
                                    <div><strong>1338</strong> Following</div>
                                </div>
                                <h4 class="text-lg font-semibold">
                                    {{ $page.props.auth.user.name }}
                                </h4>
                                <p>
                                    Frontend Developer 💻 Trying to be a Movies
                                    Enthusiast 🎬
                                </p>
                                <div>
                                    <a href="#">
                                        https://www.linkedin.com/in/alfito-devaga/
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-3">
                            <img
                                class="object-cover aspect-square"
                                src="https://images.unsplash.com/photo-1589308800645-4107ddfd5f08?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt=""
                            />
                            <img
                                class="object-cover aspect-square"
                                src="https://images.unsplash.com/photo-1589308800645-4107ddfd5f08?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt=""
                            />
                            <img
                                class="object-cover aspect-square"
                                src="https://images.unsplash.com/photo-1589308800645-4107ddfd5f08?q=80&w=1887&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                alt=""
                            />
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </AuthenticatedLayout>
</template>
