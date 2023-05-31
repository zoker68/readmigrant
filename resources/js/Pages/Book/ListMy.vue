<script setup>

import {useForm, Link} from "@inertiajs/vue3";

const form = useForm({
    message: '',
});

</script>

<template>
    <Head title="Ваши книги"/>


    <div>
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between  border-gray-200 pb-6 pt-15">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">Все Ваши книги</h1>
            </div>
        </main>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <ul role="list" class="divide-y divide-gray-100" v-if="books.length > 0">
            <li v-for="book in books" class="flex justify-between gap-x-6 py-5">
                <div class="flex gap-x-4 w-full">
                    <Link :href="route('book.show',[country.id, book.id])">
                        <img
                            v-if="book.image_main"
                            :src="`/storage/books/smallsize/` + book.image_main"
                            :alt="book.title"
                            class="h-40 w-40 object-cover object-center group-hover:opacity-75"
                        />
                        <img
                            v-else
                            src="/storage/books/smallsize/default.png"
                            :alt="book.title"
                            class="h-40 w-40 object-cover object-center group-hover:opacity-75"
                        />
                    </Link>
                    <div class="min-w-0 flex-auto align-bottom">
                        <div>
                            <p class="text-sm font-semibold leading-6 text-gray-900 ml-3">Книга: {{
                                    book.title
                                }}</p>
                            <p class="text-sm font-semibold leading-6 text-gray-900 ml-3">Автор: {{
                                    book.author
                                }}</p>
                        </div>
                        <div class="mt-10">
                            <p class="text-sm font-semibold leading-6 ml-3 align-bottom">
                                <Link :href="route('book.edit',[country.id, book.id])"
                                      class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Перейти к редактированию.
                                </Link>
                            </p>
                        </div>

                    </div>
                </div>
            </li>
        </ul>
        <p v-else>У Вас еще нет книг, которыми Вы хотели бы поделиться.</p>
    </div>

</template>


<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head} from "@inertiajs/vue3";


export default {
    name: "Index",
    components: {Head},

    props: [

        'books',
        'country',

    ],


    layout: MainLayout
}
</script>

<style scoped>
</style>
