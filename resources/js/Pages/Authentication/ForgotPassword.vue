<script setup>
import Logo from '@/Components/Logo.vue';
import Submit from '@/Components/Submit.vue';
import TextBox from '@/Components/TextBox.vue';
import Toast from '@/Components/Toast.vue';
import Authentication from '@/Layouts/Authentication.vue';
import { useForm, Link } from '@inertiajs/vue3';
import { useToastStore } from '@/Stores/toast.js'
import EnvelopeIcon from '@/Icons/EnvelopeIcon.vue';

const toast = useToastStore()
const form = useForm({
    email: '',
})

const sendRequest = () => {
    form.post(route('password.email'), {
        onSuccess: () => {
            form.reset()
            toast.openToast()
        }
    })
}
</script>

<template>
    <Authentication>
        <div class="flex flex-col gap-4 w-96 p-4 bg-white rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <div class="flex flex-col gap-2 items-center p-4 select-none">
                <Logo class="h-14 w-14 fill-red-600"/>
            </div>
            <div class="mb-4 text-sm text-gray-500">
                Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
            </div>
            <form @submit.prevent="sendRequest" class="flex flex-col gap-6">
                <div class="space-y-2">
                    <label for="email" class="flex items-center gap-1 text-sm select-none">
                        <EnvelopeIcon class="h-5 w-5"/>
                        Email Address
                    </label>
                    <TextBox type="email" id="email" v-model="form.email" autocomplete="email" />
                    <span class="text-xs text-red-600">{{ form.errors.email }}</span>
                </div>
                
                <div class="flex flex-col gap-2 items-center">
                    <Submit label="Send Reset Link" :loading="form.processing" />
                    <Link :href="route('login')" class="text-sm text-blue-600 underline">Back to Login</Link>
                </div>
            </form>
        </div>
    </Authentication>
    <Transition
        appear
        enter-active-class="transition ease-out duration-200"
        enter-from-class="translate-x-full opacity-0"
        enter-to-class="translate-x-0 opacity-100"
        leave-active-class="transition ease-in duration-200"
        leave-from-class="scale-100 opacity-100"
        leave-to-class="scale-90 opacity-0" >
        <Toast 
            title="Reset Link Sent"
            :body="$page.props.notifications.success"
            @close="toast.closeToast()"
            v-if="toast.active"
        />
    </Transition>
</template>