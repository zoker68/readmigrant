<template>
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <Link :href="route('book.index',country.id)" class="-m-1.5 p-1.5">
                    <span class="sr-only">Read Migrant</span>
                    <img class="h-8 w-auto" src="/images/logo.png" alt=""/>
                </Link>
            </div>
            <div class="flex  lg:flex-1 center text-center" v-if="country">

                <span><Link :href="route('country.index')">{{ country.title }}</Link></span>
                <Link :href="route('country.index')">
                    <img class="h-6 border border-1 ml-3 w-auto align-baseline"
                         :src="`/images/country/flag/icon/${country.id}.png`" alt=""/>
                </Link>

            </div>

            <UserMenuHeader></UserMenuHeader>

        </nav>
    </header>
    <main>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <slot/>
        </div>
    </main>

    <FooterLayout></FooterLayout>

</template>

<script setup>
import {ref} from 'vue'
import {Link} from "@inertiajs/vue3";
import UserMenuHeader from "@/Layouts/UserMenuHeader.vue";
import FooterLayout from "@/Layouts/FooterLayout.vue";


const mobileMenuOpen = ref(false)

</script>

<script>
export default {

    props: [
        'country',
        'genreAll'
    ]
}
</script>
