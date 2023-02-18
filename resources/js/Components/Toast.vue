<script setup>
import SuccessIcon from '@/Icons/SuccessIcon.vue'
import WarningIcon from '@/Icons/WarningIcon.vue'
import DangerIcon from '@/Icons/DangerIcon.vue'
import { onMounted, computed } from 'vue';

const props = defineProps({
    title: String,
    body: String,
    type: {
        type: String,
        default: 'success',
    },
    duration: {
        type: Number,
        default: 3,
    },
    persistent: {
        type: Boolean,
        default: false,
    },
})

const iconType = computed(() => {
    switch (props.type) {
        case 'success':
            return SuccessIcon
        case 'warning':
            return WarningIcon
        case 'danger':
            return DangerIcon
        default:
            return SuccessIcon
    }
})

const iconClass = computed(() => {
    switch (props.type) {
        case 'success':
            return 'h-5 w-5 stroke-2 text-green-600'
        case 'warning':
            return 'h-5 w-5 stroke-2 text-yellow-600'
        case 'danger':
            return 'h-5 w-5 stroke-2 text-red-600'
        default:
            return 'h-5 w-5 stroke-2 text-green-600'
    }
})

const emits = defineEmits(['close'])

onMounted(() => {
    /**
     * Start the timer for autohiding of toast
     */
    let timer = setTimeout(() => emits('close') , props.duration * 1000)

    /**
     * If the persistent is true remove the timer.
     */
    if(props.persistent) {
        clearTimeout(timer)
    }
})
</script>

<template>
    <div class="fixed right-8 bottom-8 p-4 bg-slate-900 rounded-lg w-96 shadow-md ring-1 ring-black ring-opacity-5">
        <div class="flex justify-between items-center">
            <span class="flex items-center gap-2 text-sm font-semibold">
                <component :is="iconType" :class="iconClass" />
                {{ title }}
            </span>
            <span class="cursor-pointer text-gray-700  hover:text-gray-200" @click="$emit('close')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </span>
        </div>
        <div class="block p-4 text-sm">
            {{ body }}
        </div>
    </div>
</template>