import { usePage } from "@inertiajs/vue3";
import { defineStore } from "pinia";

export const useToastStore = defineStore('toast', {
    state: () => {
        return {
            active: false,
        }
    },

    getters : {
        getNotification () {
            return usePage().props.notifications.success
        },
    },

    actions: {
        closeToast() {
            this.active = false
        },
        openToast() {
            this.active = true
        },
        toggleToast() {
            this.active = !this.active
        }
    }
})