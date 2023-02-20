<script setup>
import { Menu, MenuButton, MenuItems } from '@headlessui/vue'
</script>

<template>
    <Menu as="div" class="relative">
        <MenuButton as="button" class="flex items-center gap-1">
            <slot name="toggler" />
        </MenuButton>
        <Transition
            enter-active-class="transition ease-out duration-200"
            enter-from-class="scale-90 opacity-0"
            enter-to-class="scale-100 opacity-100"
            leave-active-class="transition ease-in duration-100"
            leave-from-class="scale-100 opacity-100"
            leave-to-class="scale-90 opacity-0" >
            <MenuItems as="div" class="absolute w-56 z-50 right-0 origin-top-right rounded-lg shadow mt-2 ring-1 ring-black ring-opacity-5">
                <ul class="flex flex-col py-1 gap-2 bg-white rounded-lg">
                    <slot name="menu" />
                </ul>
            </MenuItems>
        </Transition>
    </Menu>
</template>