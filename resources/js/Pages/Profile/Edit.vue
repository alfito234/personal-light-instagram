<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Head, useForm } from "@inertiajs/vue3";
import ImageInput from "@/Components/ImageInput.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref, watch, onBeforeUnmount } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true,
    },
});

const currentUser = ref(props.user);

const form = useForm({
    description: currentUser.value.profile.description,
    url: currentUser.value.profile.url,
    profile_picture: currentUser.value.profile.profile_picture,
});

const previewUrl = ref(null);

watch(
    () => form.profile_picture,
    (newFile) => {
        if (newFile instanceof File) {
            if (previewUrl.value) {
                URL.revokeObjectURL(previewUrl.value);
            }
            previewUrl.value = URL.createObjectURL(newFile);
        } else {
            previewUrl.value = `/storage/${form.profile_picture}`;
        }
    },
    { immediate: true }
);

onBeforeUnmount(() => {
    if (previewUrl.value) {
        URL.revokeObjectURL(previewUrl.value);
    }
});

const submit = () => {
    const formData = new FormData();
    formData.append("description", form.description);
    formData.append("url", form.url);

    // Tambahkan file `profile_picture` ke `FormData` jika tersedia
    if (form.profile_picture instanceof File) {
        formData.append("profile_picture", form.profile_picture);
    }

    form.patch(route("profile.update", { user: currentUser.value.id }), {
        data: formData,
        headers: {
            "Content-Type": "multipart/form-data",
        },
        onSuccess: () => {
            console.log("Profile updated successfully!");
        },
        onError: (errors) => {
            console.error("Failed to update profile:", errors);
        },
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
                    @submit.prevent="submit"
                    class="grid items-center grid-cols-7 gap-10 mt-6"
                >
                    <div class="col-span-2">
                        <img
                            :src="previewUrl"
                            alt="Profile Picture"
                            class="w-[180px] aspect-square object-cover rounded-full"
                        />
                    </div>
                    <div class="col-span-5">
                        <InputLabel
                            for="profile_picture"
                            value="Profile Picture"
                        />
                        <ImageInput
                            id="profile_picture"
                            v-model="form.profile_picture"
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
