<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    firstname: '',
    lastname: '',
    country_id: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Регистрация"/>

    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Регистрация</h2>
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >

            <form @submit.prevent="submit">
                <div>
                    <InputLabel for="name" value="Логин"/>

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="mt-2" :message="form.errors.name"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="email" value="Email"/>

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email"/>
                </div>


                <div class="mt-4">
                    <InputLabel for="firstname" value="Ваше имя"/>

                    <TextInput
                        id="firstname"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.firstname"
                        required
                        autocomplete="firstname"
                    />

                    <InputError class="mt-2" :message="form.errors.firstname"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="lastname" value="Ваша фамилия"/>

                    <TextInput
                        id="lastname"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.lastname"
                        required
                        autocomplete="lastname"
                    />

                    <InputError class="mt-2" :message="form.errors.lastname"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="country" value="Ваша страна проживания"/>

                    <select id="country" name="country_id" autocomplete="country" v-model="form.country_id"
                            class="mt-1 block w-full rounded-md border-0 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600">
                        <option v-for="country in $page.props.countryList" :value="country.id">{{ country.title }}</option>
                    </select>
                    <InputError class="mt-2" :message="form.errors.country_id"/>
                </div>

                <div class="mt-10">
                    <InputLabel for="password" value="Пароль"/>

                    <TextInput
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password"/>
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Повторите пароль"/>

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="mt-2" :message="form.errors.password_confirmation"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link
                        :href="route('login')"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Вы уже зарегистрированны?
                    </Link>

                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Зарегистрироваться
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import MainLayout from "@/Layouts/SelectCountry.vue";

export default {
    name: "Register",

    layout: MainLayout
}
</script>
