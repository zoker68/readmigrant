<template>

    <Head title="Меняйся книгами с мигрантами" />
    <div class="bg-white">{{ country.title }}
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Выберите страну</h2>

            <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="country in countries" class="group relative">

                    <div class="mt-4">
                        <div>
                            <h3 class="text-gray-700">
                                <a :href="route('index.index',country.id)">
                                    <span aria-hidden="true" class="absolute inset-0" />
                                    {{ country.title }}
                                </a>
                            </h3>
                        </div>
                    </div>
                    <div class="group-hover:opacity-75">
                        <img :src="`images/country/flag/image/${country.id}.png`" :alt="country.title" class="border-2 h-44" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Head} from "@inertiajs/vue3";



export default {
    name: "SelectCountry",
    components: {Head},

    props: [
        'country'
    ],

    layout: MainLayout
}
</script>

<style scoped>

</style>
