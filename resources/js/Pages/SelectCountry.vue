<template>
    <Head title="Выберите страну нахождения" />
    <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">Выберите страну</h2>

            <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 max-w-100">
                <div v-for="country in countries" class="group w-64">

                    <div class="mt-3">
                            <h3 class="text-gray-700 text-center">
                                <Link :href="route('book.index',country.id)">
                                    <span aria-hidden="true" class="inset-0" />
                                    {{ country.title }}
                                </Link>
                            </h3>
                    </div>
                    <div class="group-hover:opacity-75">
                        <Link :href="route('book.index',country.id)">
                            <img :src="`images/country/flag/image/${country.id}.png`" :alt="country.title" class="border-2 h-44 w-64" />
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import SelectCountry from "@/Layouts/SelectCountry.vue";
import { Head, Link} from "@inertiajs/vue3";
</script>
<script>
export default {
    name: "SelectCountry",

    props: [
        'countries'
    ],

    layout: SelectCountry
}
</script>

<style scoped>

</style>
