<script setup>
import { Link } from '@inertiajs/vue3';

</script>

<template>
    <Link :href="route('logout')" method="POST" as="button" class="block text-sm px-4 py-2 rounded-lg">Logout</Link>
</template>