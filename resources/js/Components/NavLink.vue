<script setup>
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    label: String,
    active: Boolean,
})

const activeStyle = computed(() => {
    if(props.active) {
        return 'bg-slate-900 text-white'
    } else {
        return 'hover:bg-gray-100'
    }
})
</script>

<template>
    <Link class="flex items-center gap-1 text-sm px-4 py-2 rounded-lg" :class="activeStyle">
        <slot>{{ label }}</slot>
    </Link>
</template>