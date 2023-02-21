<script setup>
import Pagination from '@/Components/Pagination.vue';
import Admin from '@/Layouts/Admin.vue';
import { Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    contacts: Object,
})

const metaData = computed(() => {
    return {
        total: props.contacts.total,
        from: props.contacts.from,
        to: props.contacts.to,
    }
})

const fullName = (firstname,lastname, middlename = null) => {
    if(!middlename) {
        return `${firstname} ${lastname}`
    }
    return `${firstname} ${middlename} ${lastname}`
}
</script>

<template>
    <Admin>
        <div class="overflow-x-auto rounded-lg bg-white">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="px-6 py-3 text-sm font-medium text-gray-700">Name</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-700">Email Address</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-700">Contact Number</th>
                        <th class="px-6 py-3 text-sm font-medium text-gray-700">Birthdate</th>
                        <th class="sr-only">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="contact in contacts.data" :key="contact.id" class="even:bg-gray-50">
                        <td class="px-6 py-3 text-sm whitespace-nowrap">{{ fullName(contact.firstname, contact.lastname, contact.middlename) }}</td>
                        <td class="px-6 py-3 text-sm whitespace-nowrap">{{ contact.email }}</td>
                        <td class="px-6 py-3 text-sm whitespace-nowrap">{{ contact.contact }}</td>
                        <td class="px-6 py-3 text-sm whitespace-nowrap">{{ contact.birthdate }}</td>
                        <td class="px-6 py-3 text-sm whitespace-nowrap">
                            <Link :href="route('contacts.show', contact.id)" class="flex items-center gap-1 text-blue-600 font-semibold">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.75" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                </svg>
                                Edit
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Pagination :links="contacts.links" :meta="metaData" />
    </Admin>
</template>