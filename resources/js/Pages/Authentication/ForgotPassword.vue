<script setup>
import Logo from '@/Components/Logo.vue';
import Submit from '@/Components/Submit.vue';
import TextBox from '@/Components/TextBox.vue';
import Authentication from '@/Layouts/Authentication.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';


const form = useForm({
    email: '',
})

const active = ref(false)

const sendRequest = () => {
    form.post(route('password.email'), {
        onSuccess: () => {
            form.reset()
            active.value = true
        }
    })
}
</script>

<template>
    <Authentication>
        <div class="flex flex-col gap-4 w-96 p-4 bg-slate-900 rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <div class="flex flex-col gap-2 items-center p-4 select-none">
                <Logo class="h-14 w-14 fill-red-600"/>
            </div>
            <div class="mb-4 text-sm text-gray-400">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </div>
            <form @submit.prevent="sendRequest" class="flex flex-col gap-6">
                <div class="space-y-2">
                    <label for="email" class="block text-sm select-none">Email Address</label>
                    <TextBox type="email" id="email" v-model="form.email" autocomplete="email" />
                    <span class="text-xs text-red-600">{{ form.errors.email }}</span>
                </div>

                <Submit label="Send Reset Link" :loading="form.processing" />
            </form>
        </div>
    </Authentication>
</template>