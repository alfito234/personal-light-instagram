<script setup>
import { ref } from "vue";
import PhotoIcon from "./PhotoIcon.vue";

const file = ref(null);

const emit = defineEmits(['update:modelValue']);

const attrs = defineProps(["id", "name"]);

const handleFileChange = (event) => {
    const selectedFile = event.target.files[0];
    file.value = selectedFile;

    emit("update:modelValue", selectedFile);
};
</script>

<template>
    <div
        class="flex justify-center px-6 py-10 mt-2 border border-dashed rounded-lg border-gray-900/25"
    >
        <div class="text-center">
            <PhotoIcon
                class="w-12 h-12 mx-auto text-gray-300"
                aria-hidden="true"
            />
            <div class="flex mt-4 text-sm text-gray-600">
                <label
                    :for="id"
                    class="relative font-semibold text-indigo-600 bg-white rounded-md cursor-pointer focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500"
                >
                    <span>Upload a file</span>
                    <input
                        :id="id"
                        class="sr-only"
                        type="file"
                        accept="image/png, image/jpeg, image/gif"
                        @change="handleFileChange"
                        v-bind="$attrs"
                    />
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="mt-2 text-xs text-gray-600">PNG, JPG, GIF up to 10MB</p>
            <p v-if="file" class="mt-2 text-xs text-gray-500">
                Selected file: {{ file.name }}
            </p>
        </div>
    </div>
</template>
