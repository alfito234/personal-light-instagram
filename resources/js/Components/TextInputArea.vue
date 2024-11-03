<script setup>
import { onMounted, ref } from "vue";

const model = defineModel({
    type: String,
    required: true,
});

const textarea = ref(null);

onMounted(() => {
    if (textarea.value.hasAttribute("autofocus")) {
        textarea.value.focus();
    }
});

defineExpose({ focus: () => textarea.value.focus() });
</script>

<template>
    <textarea
        class="border-gray-300 rounded-md shadow-sm focus:border-gray-500 focus:ring-gray-500"
        v-model="model"
        ref="textarea"
        rows="4"
    ></textarea>
</template>
