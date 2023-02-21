<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Object,
    meta: Object,
})

const setRoute = (url) => {
    if(url === null) {
        return location.href
    }
    return url
}
</script>

<template>
    <div class="flex justify-between my-4">
        <div class="text-gray-700 text-sm px-4 py-2">
            Showing {{ meta.from }} to {{ meta.to }} of {{ meta.total }} results
        </div>
        <div class="flex items-center bg-white rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <span v-for="link in links">
                <Link 
                    v-html="link.label" 
                    :href="setRoute(link.url)" 
                    :preserve-scroll="!link.url"
                    class="block text-sm px-4 py-2"
                    :class="[
                        { 'bg-slate-900 text-white': link.active },
                        { 'pointer-events-none': !link.url }
                    ]" >
                </Link>
            </span>
        </div>
    </div>    
</template>