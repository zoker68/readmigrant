<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, useForm} from '@inertiajs/vue3';
import SelectCountry from "@/Layouts/SelectCountry.vue";

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <SelectCountry>
        <Head title="Forgot Password"/>
        <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Восстановление пароля</h2>
            <div
                class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
            >
                <div class="mb-4 text-sm text-gray-600">
                    Забилы пароль? Не проблема. Только напишите Ваш e-mail и мы отправим ссылку для восстановления пароля.
                </div>

                <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div>
                        <InputLabel for="email" value="Email"/>

                        <TextInput
                            id="email"
                            type="email"
                            class="mt-1 block w-full"
                            v-model="form.email"
                            required
                            autofocus
                            autocomplete="username"
                        />

                        <InputError class="mt-2" :message="form.errors.email"/>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Отправить ссылку для сброса пароля
                        </PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </SelectCountry>
</template>
