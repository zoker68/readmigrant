<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {computed, ref} from "vue";

const country = usePage().props.country;

const forms = useForm({
    avatar: null,
})

const files = ref([])

const uploadInfo = computed(() => {
    return 'Выбран файл: ' + files.value[0].name;
})

const handleUpload = (e) => {
        files.value = Array.from(e.target.files) || []
}

</script>
<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Аватар</h2>

        </header>
        <form @submit.prevent="forms.post(route('profile.avatar.update',country.id))">
            <div>

                <InputLabel for="avatar" value="Ваша аватарка"/>

                <div class="mt-2 flex items-center gap-x-3">
                    <img v-if="$page.props.auth.user.avatar"
                         :src="`/storage/avatar/` + $page.props.auth.user.avatar"
                         alt=""/>
                    <img v-else
                         src="/storage/avatar/dafault.jpg"
                         alt=""/>
                    <label for="avatar" class="relative overflow-hidden rounded h-28
flex justify-center w-full px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-400 focus:outline-none">
                        <input
                            id="avatar"
                            type="file"
                            class="overlayed hidden"
                            :multiple="false"
                            accept="image/jpeg, image/gif, image/png"
                            @input="forms.avatar = $event.target.files[0]"
                            @change="handleUpload"
                        />
                        <span
                            :class="`overlayed  bg-gray-100 border-gray-200 border-2 text-gray-800 pointer-events-none flex justify-center items-center`"
                        >
                            <div class="text-center align-middle ">
                                 <span class="font-medium text-gray-600">
                                    Перетащите файл с новым аватаром сюда <br />или
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
                <div>
                    <InputError class="mt-2" :message="forms.errors.avatar"/>
                </div>

            </div>


            <div class="flex items-center gap-4 mt-4">
                <PrimaryButton :disabled="forms.processing">Сохранить</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="forms.recentlySuccessful" class="text-sm text-gray-600">Сохранено.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<script>
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import {computed, ref} from "vue";

export default {
    name: "UpdateAvatarForm",
    components: {InputError, InputLabel},


}

</script>

<style scoped>
    .overlayed {
        @apply absolute top-0 left-0 right-0 bottom-0 w-full  block ;
    }
</style>
