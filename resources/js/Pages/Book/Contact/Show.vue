<script setup>

import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";

const form = useForm({
    message: '',
});
</script>

<template>
    <Head title="Переписка о запосе книги"/>

    <div>
        <main class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex items-baseline justify-between  border-gray-200 pb-6 pt-15">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900">Переписка на тему запроса книги: "{{ bookData.title }}"</h1>
            </div>
        </main>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <h2 class="text-xl">Новое сообщение</h2>
        <form @submit.prevent="form.post(route('book.contact.store',[country.id, bookData.id])); form.message = '';" class="mt-6 space-y-6">


                <div >
                    <InputLabel for="message" value="Напишите Ваше сообщение ниже:" />
                    <textarea id="message" v-model="form.message" rows="3"
                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>

                    <InputError class="mt-2" :message="form.errors.message"/>
                </div>

                <div class="mt-5">
                    <PrimaryButton :disabled="form.processing">Отправить</PrimaryButton>

                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Сообщение отправлено</p>
                    </Transition>
                </div>


        </form>
        <h2 class="text-xl mt-3">Переписка: </h2>
        <ul role="list" class="divide-y divide-gray-100">
            <li v-for="message in messages" class="flex justify-between gap-x-6 py-5">
                <div class="flex gap-x-4">
                    <img v-if="message.avatar"
                         class="h-10 w-10 rounded-full"
                         :src="`/storage/avatar/` + message.avatar"
                         alt=""/>
                    <img v-else
                         class="h-10 w-10 rounded-full"
                         src="/storage/avatar/dafault.jpg"
                         alt=""/>
                    <div class="min-w-0 flex-auto">

                        <div class="flex items-center text-sm leading-6 text-gray-900">
                            <span class="font-semibold pr-4">{{ message.firstname }} {{ message.lastname }}</span>


                        </div>

                        <div class="mt-1 text-medium leading-5 text-gray-500">{{ message.message }}</div>
                    </div>
                </div>
                <div class="hidden sm:flex sm:flex-col sm:items-end  w-80">

                    <p v-if="message.date" class="mt-1 text-xs leading-5 text-gray-500">
                        Отправлено {{ message.date }}
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
        'messages',
        'country',

    ],


    layout: MainLayout
}
</script>

<style scoped>
</style>
