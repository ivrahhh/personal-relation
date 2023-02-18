<script setup>
import Logo from '@/Components/Logo.vue';
import Submit from '@/Components/Submit.vue';
import TextBox from '@/Components/TextBox.vue';
import Authentication from '@/Layouts/Authentication.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
import { useToastStore } from '@/Stores/toast.js'
import Toast from '@/Components/Toast.vue';

const toast = useToastStore()
const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const authenticate = () => {
    form.post(route('authenticate'), {
        onFinish: () => form.reset(),
        preserveScroll: true,
    })
}

onMounted(() => {
    if(toast.getNotification) {
        toast.openToast()
    }
})
</script>

<template>
    <Authentication>
        <div class="flex flex-col gap-4 w-96 p-4 bg-slate-900 rounded-lg shadow ring-1 ring-black ring-opacity-5">
            <div class="flex flex-col gap-2 items-center p-4 select-none">
                <Logo class="h-14 w-14 fill-red-600"/>
                <span class="text-xl">Log in</span>
            </div>
            <form @submit.prevent="authenticate" class="flex flex-col gap-6">
                <div class="space-y-2">
                    <label for="email" class="block text-sm select-none">Email Address</label>
                    <TextBox type="email" id="email" v-model="form.email" autocomplete="email" />
                    <span class="text-xs text-red-600">{{ form.errors.email }}</span>
                </div>

                <div class="space-y-2">
                    <label for="password" class="block text-sm select-none">Password</label>
                    <TextBox type="password" id="password" v-model="form.password" autocomplete="current-password" />
                    <span class="text-xs text-red-600">{{ form.errors.password }}</span>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-1">
                        <input type="checkbox" id="remember" v-model="form.remember" value="true" class="accent-blue-600" />
                        <label for="remember" class="block text-sm select-none">Remember Me</label>
                    </div>
                    <Link :href="route('password.request')" class="text-sm underline text-blue-600">Forgot Password</Link>
                </div>

                <Submit label="Log in" :loading="form.processing" />
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
            title="Password Reset"
            :body="$page.props.notifications.success"
            @close="toast.closeToast()"
            v-if="toast.active"
        />
    </Transition>
</template>