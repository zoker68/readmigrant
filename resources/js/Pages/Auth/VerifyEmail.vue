<script setup>
import {computed} from 'vue';
import SelectCountry from '@/Layouts/SelectCountry.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <SelectCountry>
        <Head title="Проверка email"/>


        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg bg-gray-100"
            >
                <div class="mb-4 text-sm text-gray-600">
                    Вы уже зарегистрировались. Спасибо вам за доверие. Перед тем, как вы начнете, мы просим Вас
                    подтвердить Ваш E-mail с помощью ссылки, которую мы отправили Вам на email. Если Вы не получили
                    письма, мы можем попробовать отправить вам повтороное письмо. Для этого нажмите ссылку ниже:
                </div>

                <div class="mb-4 font-medium text-sm text-green-600" v-if="verificationLinkSent">
                    На адрес электронной почты, который вы указали при регистрации, была отправлена новая ссылка для
                    подтверждения.
                </div>

                <form @submit.prevent="submit">
                    <div class="mt-4 flex items-center justify-between">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Послать новую ссылку
                        </PrimaryButton>

                        <Link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >Выйти из аккаунта
                        </Link
                        >
                    </div>
                </form>
            </div>
        </div>
    </SelectCountry>
</template>
