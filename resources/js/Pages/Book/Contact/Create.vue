<script setup>
import {useForm} from '@inertiajs/vue3';
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";


const form = useForm({
    message: '',
});

</script>

<template>
    <Head title="Запрос на книгу книги"/>
       <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 pb-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Запрос на книгу: "{{ bookData.title }}"</h2>
        </div>

        <form @submit.prevent="form.post(route('book.contact.store',[country.id, bookData.id]))" class="mt-6 space-y-6">

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">

                <div >
                    <InputLabel for="message" value="Напишите запрос владельцу книги" />
                    <p class="mt-2 text-sm text-gray-600">
                        Напишите о том, где вы находитесь, какой способ передачи книги Вас интересует.
                        Помимо данных, которые Вы напишете в этом поле мы сообщим владельцу книги данные о том, какую книгу Вы запрашиваете, Ваше имя и фамилию.
                    </p>
                    <textarea id="message" v-model="form.message" rows="3"
                              class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>

                    <InputError class="mt-2" :message="form.errors.message"/>
                </div>

                <div class="mt-5">
                    <PrimaryButton :disabled="form.processing">Отправить запрос</PrimaryButton>

                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Запрос отправлен.</p>
                    </Transition>
                </div>

            </div>

        </form>

</template>


<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head} from "@inertiajs/vue3";


export default {
    name: "Create",
    components: {Head},

    props: [
        'authors',
        'genreAll',
        'country',
        'bookData',
    ],


    layout: MainLayout
}
</script>

<style scoped>
</style>
