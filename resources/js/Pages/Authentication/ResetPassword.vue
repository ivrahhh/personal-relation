<script setup>
import Logo from '@/Components/Logo.vue';
import Submit from '@/Components/Submit.vue';
import TextBox from '@/Components/TextBox.vue';
import EnvelopeIcon from '@/Icons/EnvelopeIcon.vue';
import KeyIcon from '@/Icons/KeyIcon.vue';
import Authentication from '@/Layouts/Authentication.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    email: String,
    token: String,
})

const form = useForm({
    email: props.email,
    token: props.token,
    password: '',
    password_confirmation: '',
})

const resetPassword = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password','password_confirmation'),
        preserveScroll: true,
    })
}
</script>

<template>
    <Authentication>
        <div class="flex flex-col gap-4 w-96 p-4 bg-slate-900 rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <div class="flex flex-col gap-2 items-center p-4 select-none">
                <Logo class="h-14 w-14 fill-red-600"/>
            </div>
            <form @submit.prevent="resetPassword" class="flex flex-col gap-6">
                <div class="space-y-2">
                    <label for="email" class="flex items-center gap-1 text-sm select-none">
                        <EnvelopeIcon class="h-5 w-5"/>
                        Email Address
                    </label>
                    <TextBox type="email" id="email" v-model="form.email" autocomplete="email" />
                    <span class="text-xs text-red-600">{{ form.errors.email }}</span>
                </div>

                <div class="space-y-2">
                    <label for="password" class="flex items-center gap-1 text-sm select-none">
                        <KeyIcon class="h-5 w-5 text-white" />
                        Password
                    </label>
                    <TextBox type="password" id="password" v-model="form.password" autocomplete="new-password" />
                    <span class="text-xs text-red-600">{{ form.errors.password }}</span>
                </div>

                <div class="space-y-2">
                    <label for="password" class="flex items-center gap-1 text-sm select-none">
                        <KeyIcon class="h-5 w-5 text-white" />
                        Confirm Password
                    </label>
                    <TextBox type="password" id="password" v-model="form.password_confirmation" autocomplete="new-password" />
                    <span class="text-xs text-red-600">{{ form.errors.password_confirmation }}</span>
                </div>

                <Submit label="Reset Password" :loading="form.processing" />
            </form>
        </div>
    </Authentication>
</template>