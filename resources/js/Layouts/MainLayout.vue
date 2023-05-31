<template>
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <Link :href="route('country.index')" class="-m-1.5 p-1.5">
                    <span class="sr-only">Read Migrant</span>
                    <img class="h-8 w-auto" src="/images/logo.png" alt=""/>
                </Link>
            </div>
            <div class="flex  lg:flex-1 center text-center" v-if="country">
                <span>{{ country.title }}</span>
                <img class="h-6 border border-1 ml-3 w-auto align-baseline"
                     :src="`/images/country/flag/icon/${country.id}.png`" alt=""/>
            </div>
            <div class="flex lg:hidden">
                <button type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true">
                    <span class="sr-only">Открыть основное меню</span>
                    <Bars3Icon class="h-6 w-6" aria-hidden="true"/>
                </button>
            </div>
            <PopoverGroup class="hidden lg:flex lg:gap-x-12">
                <Link :href="route('book.index',country.id)" class="text-sm font-semibold leading-6 text-gray-900">Все
                    книги
                </Link>
                <Popover class="relative">
                    <PopoverButton class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900">
                        По жанрам
                        <ChevronDownIcon class="h-5 w-5 flex-none text-gray-400" aria-hidden="true"/>
                    </PopoverButton>

                    <transition enter-active-class="transition ease-out duration-200"
                                enter-from-class="opacity-0 translate-y-1" enter-to-class="opacity-100 translate-y-0"
                                leave-active-class="transition ease-in duration-150"
                                leave-from-class="opacity-100 translate-y-0" leave-to-class="opacity-0 translate-y-1">
                        <PopoverPanel
                            class="absolute -left-8 top-full z-10 mt-3 w-screen max-w-md overflow-hidden rounded-3xl bg-white shadow-lg ring-1 ring-gray-900/5">
                            <div class="p-4">
                                <div v-for="genre in genreAll"
                                     class="group relative flex items-center gap-x-6 rounded-lg p-2 text-sm leading-6 hover:bg-gray-50">
                                    <div class="flex-auto">
                                        <Link :href="route('book.index',[country.id, {'genre[]': genre.id}])"
                                              class="block font-semibold text-gray-900">
                                            {{ genre.title }}
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </PopoverPanel>
                    </transition>
                </Popover>

                <Link :href="route('book.create',country.id)" class="text-sm font-semibold leading-6 text-gray-900">
                    Добавить книгу
                </Link>
            </PopoverGroup>


            <UserMenuHeader></UserMenuHeader>

        </nav>

        <Dialog as="div" class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
            <div class="fixed inset-0 z-10"/>
            <DialogPanel
                class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <a href="#" class="-m-1.5 p-1.5">
                        <span class="sr-only">Read Migrant</span>
                        <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                             alt=""/>
                    </a>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                        <span class="sr-only">Close menu</span>
                        <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <Link :href="route('book.create',country.id)"
                                  class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                Все книги
                            </Link>

                            <Disclosure as="div" class="-mx-3" v-slot="{ open }">
                                <DisclosureButton
                                    class="flex w-full items-center justify-between rounded-lg py-2 pl-3 pr-3.5 text-base font-semibold leading-7 hover:bg-gray-50">
                                    Жанры
                                    <ChevronDownIcon :class="[open ? 'rotate-180' : '', 'h-5 w-5 flex-none']"
                                                     aria-hidden="true"/>
                                </DisclosureButton>
                                <DisclosurePanel class="mt-2 space-y-2">
                                    <DisclosureButton v-for="genre in genreAll"
                                                      as="a" :href="route('book.index',[country.id, {'genre[]': genre.id}])"
                                                      class="block rounded-lg py-0 pl-6 pr-3 text-sm font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                        {{ genre.title }}
                                    </DisclosureButton>
                                </DisclosurePanel>
                            </Disclosure>
                            <Link :href="route('book.create',country.id)"
                                  class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">
                                Добавить книгу
                            </Link>
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>
    <main>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <slot/>
            </div>
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
        'country',
        'genreAll'
    ]
}
</script>
