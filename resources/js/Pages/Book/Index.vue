<script setup>
import {ref} from 'vue'
import {
    Dialog,
    DialogPanel,
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
    TransitionChild,
    TransitionRoot,
} from '@headlessui/vue'
import {XMarkIcon} from '@heroicons/vue/24/outline'
import {FunnelIcon, MinusIcon, PlusIcon} from '@heroicons/vue/20/solid'
import {Link, useForm, usePage} from "@inertiajs/vue3";


const mobileFiltersOpen = ref(false)

const country = usePage().props.country;
const books = usePage().props.books.data;

const searchData = usePage().props.searchData;
const paginateLink = usePage().props.books.links;

const search = useForm({
    search: searchData.search,
    searchCity: searchData.searchCity,
    genre: searchData.genre || [],
})
</script>

<template>
    <Head title="Все книги библиотеки"/>


    <div>
        <!-- Mobile filter dialog -->
        <TransitionRoot as="template" :show="mobileFiltersOpen">
            <Dialog as="div" class="relative z-40 lg:hidden" @close="mobileFiltersOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300"
                                 enter-from="opacity-0" enter-to="opacity-100"
                                 leave="transition-opacity ease-linear duration-300" leave-from="opacity-100"
                                 leave-to="opacity-0">
                    <div class="fixed inset-0 bg-black bg-opacity-25"/>
                </TransitionChild>

                <div class="fixed inset-0 z-40 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform"
                                     enter-from="translate-x-full" enter-to="translate-x-0"
                                     leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0"
                                     leave-to="translate-x-full">
                        <DialogPanel
                            class="relative ml-auto flex h-full w-full max-w-xs flex-col overflow-y-auto bg-white py-4 pb-12 shadow-xl">
                            <div class="flex items-center justify-between px-4">
                                <h2 class="text-lg font-medium text-gray-900">Фильтры</h2>
                                <button type="button"
                                        class="-mr-2 flex h-10 w-10 items-center justify-center rounded-md bg-white p-2 text-gray-400"
                                        @click="mobileFiltersOpen = false">
                                    <span class="sr-only">Закрыть меню</span>
                                    <XMarkIcon class="h-6 w-6" aria-hidden="true"/>
                                </button>
                            </div>

                            <!-- Filters -->
                            <form @change.prevent="search.get(route('book.index',country.id))"
                                  @submit.prevent="search.get(route('book.index',country.id))"
                                  class="mt-4 border-t border-gray-200">
                                <div class="relative mb-4">
                                    <input type="search"
                                           v-model="search.search"
                                           class="block w-full p-2 pl-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Искать по названию / автору">
                                    <input type="searchCity"
                                           v-model="search.searchCity"
                                           class="block w-full mt-1 p-2 pl-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                           placeholder="Искать по городу">
                                    <button type="submit"
                                            class="text-white absolute right-1 bottom-1.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-1 py-1 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Искать
                                    </button>
                                </div>


                                <Disclosure as="div"
                                            class="border-t border-gray-200 px-4 py-6" v-slot="{ open }">
                                    <h3 class="-mx-2 -my-3 flow-root">
                                        <DisclosureButton
                                            class="flex w-full items-center justify-between bg-white px-2 py-3 text-gray-400 hover:text-gray-500">
                                            <span class="font-medium text-gray-900">Жанры</span>
                                            <span class="ml-6 flex items-center">
                                              <PlusIcon v-if="!open" class="h-5 w-5" aria-hidden="true"/>
                                              <MinusIcon v-else class="h-5 w-5" aria-hidden="true"/>
                                            </span>
                                        </DisclosureButton>
                                    </h3>
                                    <DisclosurePanel class="pt-6">
                                        <div class="space-y-6">
                                            <div v-for="genre in genreAll"
                                                 class="flex items-center">
                                                <input :id="`filter-mobile-genre-${genre.id}`"
                                                       :name="`genre[]`" :value="genre.id" v-model="search.genre"
                                                       type="checkbox"
                                                       class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                                <label :for="`filter-mobile-genre-${genre.id}`"
                                                       class="ml-3 min-w-0 flex-1 text-gray-500">{{
                                                        genre.title
                                                    }}</label>
                                            </div>
                                        </div>
                                    </DisclosurePanel>
                                </Disclosure>
                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-15">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">Доступные книги</h1>

                <div class="flex items-center">
                    <button type="button" class="-m-2 ml-4 p-2 text-gray-400 hover:text-gray-500 sm:ml-6 lg:hidden"
                            @click="mobileFiltersOpen = true">
                        <span class="sr-only">Filters</span>
                        <FunnelIcon class="h-5 w-5" aria-hidden="true"/>
                    </button>
                </div>
            </div>

            <section aria-labelledby="products-heading" class="pb-24 pt-6">
                <div class="grid grid-cols-1 gap-x-8 gap-y-10 lg:grid-cols-4">
                    <!-- Filters -->
                    <form @change.prevent="search.get(route('book.index',country.id))"
                          @submit.prevent="search.get(route('book.index',country.id))" class="hidden lg:block">
                        <div class="relative mb-4">
                            <input type="search" id="default-search"
                                   v-model="search.search"
                                   class="block w-full p-2 pl-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Искать по названию / автору">
                            <input type="searchCity"
                                   v-model="search.searchCity"
                                   class="block w-full mt-1 p-2 pl-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Искать по городу">
                        </div>


                        <h3 class="mb-4">
                            <span class="font-medium text-gray-900">Жанры</span>
                        </h3>
                        <div class="space-y-4">
                            <div v-for="genre in genreAll"
                                 class="flex items-center">
                                <input :id="`filter-genre-${genre.id}`" v-model="search.genre"
                                       :value="genre.id" type="checkbox"
                                       :name="`filter-genre-${genre.id}`"
                                       class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                <label :for="`filter-genre-${genre.id}`"
                                       class="ml-3 text-sm text-gray-600">{{ genre.title }}</label>
                            </div>
                        </div>
                    </form>

                    <!-- Product grid -->
                    <div class="lg:col-span-3">
                        <div
                            class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 xl:gap-x-8"
                            v-if="books.length > 0">

                            <Link v-for="book in books" :key="book.id" :href="route('book.show', [country.id, book.id])"
                                  class="group">
                                <div
                                    class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-lg bg-gray-200 xl:aspect-h-8 xl:aspect-w-7">

                                    <img
                                        v-if="book.image_main"
                                        :src="`/storage/books/smallsize/` + book.image_main"
                                        :alt="book.title"
                                        class="h-full w-full object-cover object-center group-hover:opacity-75"
                                    />
                                    <img
                                        v-else
                                        src="/storage/books/smallsize/default.png"
                                        :alt="book.title"
                                        class="h-full w-full object-cover object-center group-hover:opacity-75"
                                    />
                                </div>
                                <h3 class="mt-4 text-xl text-gray-900">{{ book.title }}</h3>
                                <h4 class="mt-0 text-sm text-gray-700">{{ book.author }}</h4>
                                <h4 class="mt-0 text-sm text-gray-700 flex">В городе: "{{ book.city }}" <img
                                    class="h-4 border border-1 ml-1 w-auto align-baseline"
                                    :src="`/images/country/flag/icon/${book.country_id}.png`"
                                    :alt="book.countryTitle" :title="book.countryTitle"/></h4>
                            </Link>

                        </div>
                        <div
                            v-else>
                            <h2 class="text-center mt-6 text-xl">К сожалению, по заданным критериям, нет доступных
                                книг.</h2>
                        </div>

                        <nav class="mt-5 isolate inline-flex -space-x-px rounded-md shadow-sm " aria-label="Pagination"
                             v-if="usePage().props.books.last_page > 1">

                            <Link v-if="usePage().props.books.current_page > 1"
                                  :href="usePage().props.books.prev_page_url"
                                  class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Предыдущая</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </Link>

                            <template v-for="link in paginateLink">
                                <template v-if="Number(link.label) && (
                                              (usePage().props.books.current_page-link.label < 2 && usePage().props.books.current_page-link.label > -2)
                                              ||  Number(link.label) === 1 || Number(link.label) === usePage().props.books.last_page
                                          )">
                                    <Link :href="link.url"
                                          :class="link.active ? 'relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' :'relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex'">
                                        {{ link.label }}
                                    </Link>
                                </template>

                                <template v-if="
                                          Number(link.label) &&
                                          ((usePage().props.books.current_page !== 3 &&
                                          usePage().props.books.current_page - link.label === 2) ||
                                          (usePage().props.books.current_page !== usePage().props.books.last_page - 2  &&
                                          usePage().props.books.current_page - link.label === -2)
                                          )">
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>
                                </template>
                            </template>

                            <Link v-if="usePage().props.books.current_page < usePage().props.books.last_page"
                                  :href="usePage().props.books.next_page_url"
                                  class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                          d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </Link>
                        </nav>
                    </div>
                </div>
            </section>
        </main>
    </div>

</template>


<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head} from "@inertiajs/vue3";


export default {
    name: "Index",
    components: {Head},

    props: [
        'genreAll'
    ],


    layout: MainLayout
}
</script>

<style scoped>
</style>
