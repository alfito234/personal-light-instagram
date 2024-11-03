<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInputArea from "@/Components/TextInputArea.vue";
import { Head, useForm } from "@inertiajs/vue3";
import ImageInput from "@/Components/ImageInput.vue";

const form = useForm({
    caption: "",
    image: "",
});

const submit = () => {
    form.post(route("post.store"), {
        onFinish: () => form.reset("caption", "image"),
    });
};
</script>

<template>
    <Head title="Create Post" />

    <AuthenticatedLayout>
        <div>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Create Post
            </h2>
        </div>

        <div class="py-12">
            <div class="max-w-xl mx-auto bg-white rounded-xl sm:p-6 lg:p-8">
                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="caption" value="Caption" />
                        <TextInputArea
                            id="caption"
                            class="block w-full mt-1"
                            v-model="form.caption"
                            rows="3"
                            autofocus
                        />

                        <InputError
                            class="mt-2"
                            :message="form.errors.caption"
                        />
                    </div>

                    <div>
                        <InputLabel for="image" value="Image" />
                        <ImageInput
                            id="image"
                            name="image"
                            v-model="form.image"
                        />

                        <InputError class="mt-2" :message="form.errors.image" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton
                            class="ms-4"
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Post
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
