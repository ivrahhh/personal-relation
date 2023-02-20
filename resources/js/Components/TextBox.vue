<script setup>
defineProps({
    modelValue: String,
})
defineEmits(['update:modelValue'])
</script>

<template>
    <input 
        :value="modelValue"
        @change="$emit('update:modelValue', $event.target.value)"
        class="block w-full rounded-lg text-sm px-4 py-2 bg-gray-50 border border-gray-300
                focus:ring-1 focus:outline-none focus:ring-blue-600 focus:border-blue-600"
    />
</template>