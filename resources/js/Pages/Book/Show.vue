<script setup>

import {CheckIcon, StarIcon, XMarkIcon} from '@heroicons/vue/20/solid'
import {Link} from "@inertiajs/vue3";
</script>

<template>
    <Head title="Все книги библиотеки"/>


    <div>
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between border-b border-gray-200 pb-6 pt-15">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">Книга: "{{ bookData.title }}"</h1>
            </div>

            <div
                class="mx-auto max-w-2xl px-4 pb-10 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto,auto,1fr] lg:gap-x-8 lg:px-8 lg:pb-10 lg:pt-16">
                <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Автор {{
                            bookData.author
                        }}</h1>
                </div>

                <!-- Options -->
                <div class="mt-4 lg:row-span-3 lg:mt-0">
                    <div class="aspect-h-4 aspect-w-3 hidden overflow-hidden rounded-lg lg:block">
                        <img v-if="bookData.image_main" :src="`/storage/books/fullsize/` + bookData.image_main"
                             :alt="bookData.title" class="h-full w-full object-cover object-center"/>
                    </div>
                    <!-- Reviews -->
                    <div class="mt-6">
                        <h3 class="sr-only">Reviews</h3>
                        <div class="flex items-center">
                            <div class="flex items-center">
                                <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating"
                                          :class="[Math.round(ratingData.avg) > rating ? 'text-gray-900' : 'text-gray-200', 'h-5 w-5 flex-shrink-0']"
                                          aria-hidden="true"/>
                            </div>
                            <p class="sr-only">{{ ratingData.avg }} из 5</p>
                            <p class="ml-3 text-sm font-medium">{{
                                    ratingData.count
                                }}
                                <template v-if="ratingData.count == 0 || ratingData.count > 4">оценок</template>
                                <template v-if="ratingData.count == 1">оценка</template>
                                <template v-if="ratingData.count > 1 && ratingData.count < 4">оценки</template>
                            </p>
                        </div>
                    </div>
                    <form class="mt-10">

                        <Link :href="route('book.contact.create', [country.id, bookData.id])"
                                class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Связаться с владельцем
                        </Link>
                    </form>
                </div>

                <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
                    <!-- Description and details -->
                    <div v-if="bookData.description">
                        <h3 class="text-xl font-medium text-gray-900">Описание книги</h3>

                        <div class="mt-2">
                            <p class="text-base text-gray-900">{{ bookData.description }}</p>
                        </div>
                    </div>

                    <div class="mt-5" v-if="bookData.conditions">
                        <h3 class="text-xl font-medium text-gray-900">Условия получения книги:</h3>

                        <div class="mt-2">
                            {{ bookData.conditions }}
                        </div>
                    </div>

                    <div class="mt-5">
                        <h2 class="text-xl font-medium text-gray-900">Местонахождение книги</h2>

                        <div class="mt-2 space-y-6 flex">
                            <p class="text-sm text-gray-600 flex">{{ bookData.city }} - {{ bookData.country }} <img
                                class="flex h-5 border border-1 ml-2 w-auto align-baseline"
                                :src="`/images/country/flag/icon/${bookData.country_id}.png`" alt=""/></p>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h2 class="text-xl font-medium text-gray-900">Владелец книги</h2>

                        <div class="mt-2 space-y-6 flex">
                            <p class="text-sm text-gray-600 flex">{{ bookData.firstname }} {{
                                    bookData.lastname
                                }} </p>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h2 class="text-xl font-medium text-gray-900">Информация досутпности книги:</h2>

                        <div class="mt-2 space-y-2">
                            <div class="text-s text-gray-600 flex">

                                <template v-if="bookData.is_published">
                                    <CheckIcon class="h-6 w-6 flex-none text-green-600 mr-1" aria-hidden="true"/>
                                    Книга сейчас доступна! Вы можете написать владельцу запрос.
                                </template>
                                <template v-else>
                                    <XMarkIcon class="h-6 w-6 flex-none text-red-600 mr-1" aria-hidden="true"/>
                                    К сожалению, книга не доступна в текущий момент
                                </template>
                            </div>
                            <div class="text-s text-gray-600 flex">
                                <template v-if="bookData.mailed">
                                    <CheckIcon class="h-6 w-6 flex-none text-green-600 mr-1" aria-hidden="true"/>
                                    Владелец готов отправить книгу почтой
                                </template>
                                <template v-else>
                                    <XMarkIcon class="h-6 w-6 flex-none text-red-600 mr-1" aria-hidden="true"/>
                                    К сожалению, Владелец не готов отправлять книгу почтой
                                </template>
                            </div>

                            <template v-if="bookData.mailed && bookData.send_border">
                                <div class="text-s text-gray-600 flex">
                                    <CheckIcon class="h-6 w-6 flex-none text-green-600 mr-1" aria-hidden="true"/>
                                    Владелец готов отправить книгу почтой в другую страну
                                </div>
                            </template>

                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg" v-if="ratings.length > 0">
        <h2 class="text-xl">Комментарии: </h2>
        <ul role="list" class="divide-y divide-gray-100">
            <li v-for="rating in ratings" class="flex justify-between gap-x-6 py-5">
                <div class="flex gap-x-4">
                    <img v-if="rating.avatar"
                         class="h-30 w-30 rounded-full"
                         :src="`/storage/avatar/` + rating.avatar"
                         alt=""/>
                    <img v-else
                         class="h-30 w-30 rounded-full"
                         src="/storage/avatar/dafault.jpg"
                         alt=""/>
                    <div class="min-w-0 flex-auto">

                        <div class="flex items-center text-sm leading-6 text-gray-900">
                            <span class="font-semibold pr-4">{{ rating.firstname }} {{ rating.lastname }}</span>


                        </div>

                        <div class="mt-1 text-medium leading-5 text-gray-500">{{ rating.comment }}</div>
                    </div>
                </div>
                <div class="hidden sm:flex sm:flex-col sm:items-end  w-80">

                    <div class="flex items-center">

                        <StarIcon v-for="r in [0, 1, 2, 3, 4]" :key="r"
                                  :class="[rating.rating > r ? 'text-gray-900' : 'text-gray-200', 'h-4 w-4 flex-shrink-0']"
                                  aria-hidden="true"/>
                    </div>
                    <p v-if="rating.date" class="mt-1 text-xs leading-5 text-gray-500">
                        Размещено {{ rating.date }}
                    </p>
                </div>
            </li>
        </ul>
    </div>

</template>


<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head} from "@inertiajs/vue3";


export default {
    name: "Index",
    components: {Head},

    props: [
        'bookData',
        'ratings',
        'ratingData',
        'genreAll',
        'country',

    ],


    layout: MainLayout
}
</script>

<style scoped>
</style>
