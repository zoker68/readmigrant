<script setup>
import {Link, useForm, usePage} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {computed, ref} from "vue";


const country = usePage().props.country;
const countryList = usePage().props.countryList;
const book = usePage().props.book;

const form = useForm({
    title: book.title,
    author: book.author,
    genre: book.genres,
    description: book.description,
    image_main: '',
    country_id: book.country_id,
    city: book.city,
    conditions: book.conditions,
    is_published: book.is_published,
    mailed: book.mailed,
    send_border: book.send_border,

});


const files = ref([])

const uploadInfo = computed(() => {
    return 'Выбран файл: ' + files.value[0].name;
})

const handleUpload = (e) => {
    files.value = Array.from(e.target.files) || []
}
</script>

<template>
    <Head title="Добавление новой книги"/>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 pb-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Редактирование книги</h2>
    </div>
    <form @submit.prevent="form.post(route('book.update',[country.id, book.id]))" class="mt-6 space-y-6">

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div>
                <h2 class="text-lg font-medium text-gray-900">Основная информация о книге</h2>
            </div>
            <div class="mt-5">
                <InputLabel for="title" value="Название книги"/>

                <TextInput
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autocomplete="title"
                />

                <InputError class="mt-2" :message="form.errors.title"/>
            </div>

            <div class="mt-5">
                <InputLabel for="author" value="Автор"/>

                <TextInput
                    id="author"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.author"
                    required
                    autocomplete="author"
                />

                <InputError class="mt-2" :message="form.errors.author"/>
            </div>

            <div class="mt-5">
                <InputLabel for="genre" value="Жанры"/>

                <select multiple="true" id="genre" name="genre_id" autocomplete="genre" v-model="form.genre" required
                        class="mt-1 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                    <option v-for="genre in genreAll" :value="genre.id">{{ genre.title }}</option>
                </select>

                <InputError class="mt-2" :message="form.errors.genre"/>
            </div>

            <div class="mt-5">
                <InputLabel for="description" value="Описание книги (по желанию)"/>
                <p class="mt-2 text-sm text-gray-600">Можете написать тут, почему вам понравилась эта книга или что-то,
                    почему ее нужно прочитать.</p>
                <textarea id="description" v-model="form.description" rows="3"
                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>

                <InputError class="mt-2" :message="form.errors.description"/>
            </div>

            <div class="mt-5">
                <InputLabel for="image_main" value="Обложка книги"/>
                <div class="flex">
                    <img v-if="$page.props.book.image_main"
                         :src="`/storage/books/smallsize/` + $page.props.book.image_main"
                         alt=""
                         class="w-28 h-28 mr-3"
                    />
                    <label for="image_main" class="relative overflow-hidden rounded h-28
flex justify-center w-full px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">

                        <input
                            id="image_main"
                            type="file"
                            class="overlayed hidden"
                            :multiple="false"
                            accept="image/jpeg, image/gif, image/png"
                            @input="form.image_main = $event.target.files[0]"
                            @change="handleUpload"
                        />
                        <span
                            :class="`overlayed  bg-gray-100 border-gray-200 border-2 text-gray-800 pointer-events-none flex justify-center items-center`"
                        >
                            <div class="text-center align-middle ">
                                 <span class="font-medium text-gray-600">
                                    Перетащите файл с обложкой сюда <br/>или
                                    <span class="text-blue-600 underline">выберите тут</span>
                                </span>

                                <small v-if="files.length" :class="`flex justify-center items-center`">
                                  <slot name="file" :files="files" :uploadInfo="uploadInfo">
                                    {{ uploadInfo }}
                                  </slot>
                                </small>
                            </div>
                        </span>
                    </label>
                </div>
                <InputError class="mt-2" :message="form.errors.image_main"/>
            </div>

        </div>

        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div>
                <h2 class="text-lg font-medium text-gray-900">Дополнительная информация</h2>
            </div>
            <div class="mt-5">
                <InputLabel for="title" value="Страна нахождения"/>

                <select id="country" name="country_id" autocomplete="form.country" v-model="form.country_id"
                        class="block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                    <option v-for="country in countryList" :value="country.id">{{ country.title }}</option>
                </select>

                <InputError class="mt-2" :message="form.errors.country_id"/>
            </div>


            <div class="mt-5">
                <InputLabel for="city" value="Город"/>

                <TextInput
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                    required
                    autocomplete="city"
                />

                <InputError class="mt-2" :message="form.errors.city"/>
            </div>

            <div class="mt-5">
                <InputLabel for="conditions" value="Условия аренды книги"/>
                <p class="mt-2 text-sm text-gray-600">Можете написать тут, например сумму, которую Вы хотели бы получить
                    за пользование книгой, либо какой-то залог, который хотели бы получить на время пользования книгой.
                    Или же может Вас интересует обмен книгами?</p>
                <textarea id="conditions" v-model="form.conditions" rows="3"
                          class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"/>

                <InputError class="mt-2" :message="form.errors.conditions"/>
            </div>

            <fieldset>
                <InputLabel for="conditions" value="Возможные опции обмена:"/>
                <div class="mt-6 space-y-6">
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="is_published" v-model="form.is_published"
                                   true-value="1"
                                   false-value="0"
                                   type="checkbox"
                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm leading-6">
                            <label for="is_published" class="font-medium text-gray-900">Книга сейчас доступна?</label>
                            <p class="text-gray-500">Отметьте галочкой, если хотите сейчас сделать книгу доступной для
                                передачи</p>
                        </div>
                    </div>
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="mailed" v-model="form.mailed" true-value="1"
                                   false-value="0" type="checkbox"
                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm leading-6">
                            <label for="mailed" class="font-medium text-gray-900">Отправка почтой по стране Вашего
                                нахождения</label>
                            <p class="text-gray-500">Отметьте, если вы готовы отправить свою книгу почтой по стране
                                Вашего нахождения</p>
                        </div>
                    </div>
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="send_border" true-value="1"
                                   false-value="0" v-model="form.send_border" type="checkbox"
                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                        </div>
                        <div class="text-sm leading-6">
                            <label for="send_border" class="font-medium text-gray-900">Могу отправить за границу</label>
                            <p class="text-gray-500">Отметьте, если вы сможете отправить книгу за границу.</p>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>


        <div class="flex items-center gap-4">
            <PrimaryButton :disabled="form.processing">Сохранить изменения</PrimaryButton>

            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Изменения сохранены.</p>
            </Transition>
        </div>

    </form>

</template>


<script>
import {PhotoIcon, UserCircleIcon} from '@heroicons/vue/24/solid'
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head} from "@inertiajs/vue3";


export default {
    name: "Create",
    components: {Head},

    props: [
        'authors',
        'genreAll'
    ],


    layout: MainLayout
}
</script>

<style scoped>
.overlayed {
    @apply absolute top-0 left-0 right-0 bottom-0 w-full  block ;
}
</style>
