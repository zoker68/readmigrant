<template>
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <Link :href="route('country.index')" class="-m-1.5 p-1.5">
                    <span class="sr-only">Read Migrant</span>
                    <img class="h-8 w-auto" src="/images/logo.png" alt=""/>
                </Link>
            </div>

            <div v-if="$page.props.auth.user">Вы авторизованы как: {{$page.props.auth.user.name}}</div>
            <UserMenuHeader></UserMenuHeader>

        </nav>

    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <slot/>
        </div>
    </main>
</template>

<script setup>
import {ref} from 'vue'
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    Popover,
    PopoverButton,
    PopoverGroup,
    PopoverPanel
} from '@headlessui/vue'
import {Bars3Icon, XMarkIcon,} from '@heroicons/vue/24/outline'
import {ChevronDownIcon} from '@heroicons/vue/20/solid'
import {Link} from "@inertiajs/vue3";
import UserMenuHeader from "@/Layouts/UserMenuHeader.vue";


const mobileMenuOpen = ref(false)
</script>

<script>
export default {

    props: [
        'country'
    ]
}
</script>
