<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    label: String,
})
</script>

<template>
    <Link class="flex items-center gap-1 text-sm px-4 py-3">
        <slot>{{ label }}</slot>
    </Link>
</template>