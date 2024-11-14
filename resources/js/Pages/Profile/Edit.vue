<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, router, useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
import { ref, watch, onBeforeUnmount } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const form = useForm({
    description: props.user.profile.description,
    url: props.user.profile.url,
    profile_picture: null,
});

const previewImage = ref(props.user.profile.profile_picture);

const handleFileChange = (e) => {
    form.profile_picture = e.target.files[0];
    previewImage.value = URL.createObjectURL(e.target.files[0]);
};

const submit = (id) => {
    form.post(route("profile.update", { user: id }), {
        _method: "patch",
        forceFormData: true,
    });
};
</script>

<template>
    <Head title="Edit Profile" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-4xl px-10 py-6 mx-auto bg-white rounded-lg">
                <header>
                    <h2 class="text-lg font-bold text-gray-900">
                        Edit Profile
                    </h2>
                </header>
                <form
                    @submit.prevent="submit(props.user.id)"
                    enctype="multipart/form-data"
                    class="grid items-center grid-cols-7 gap-10 mt-6"
                >
                    <div class="col-span-2">
                        <img
                            :src="previewImage"
                            alt="Profile Picture"
                            class="w-[180px] aspect-square object-cover rounded-full"
                        />
                    </div>
                    <div class="col-span-5">
                        <InputLabel
                            for="profile_picture"
                            value="Profile Picture"
                        />
                        <input
                            type="file"
                            id="profile_picture"
                            accept="image/*"
                            @input="handleFileChange"
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.profile_picture"
                        />
                        <InputLabel for="description" value="Description" />
                        <TextInput
                            id="description"
                            type="text"
                            class="block w-full mt-1"
                            v-model="form.description"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.description"
                        />

                        <InputLabel
                            for="url"
                            value="Profile URL"
                            class="mt-4"
                        />
                        <TextInput
                            id="url"
                            type="url"
                            class="block w-full mt-1"
                            v-model="form.url"
                        />
                        <InputError class="mt-2" :message="form.errors.url" />

                        <div class="grid justify-end">
                            <PrimaryButton
                                class="mt-4 w-fit"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                                >Submit</PrimaryButton
                            >
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
