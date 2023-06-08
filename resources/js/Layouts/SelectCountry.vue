<template>
    <header class="bg-white">
        <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <Link :href="$page.props.auth.user ? route('book.index',$page.props.auth.user.country_id) : route('country.index') " class="-m-1.5 p-1.5">
                    <img class="h-8 w-auto" src="/images/logo.png" alt="Read Migrant logo" title="Read Migrant - перейти к списку книг"/>
                </Link>
            </div>
            <div v-if="$page.props.auth.user">Вы авторизованы как: {{ $page.props.auth.user.name }}</div>

            <UserMenuHeader></UserMenuHeader>

        </nav>

    </header>
    <main>
        <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
            <slot/>
        </div>
    </main>

    <FooterLayout></FooterLayout>
</template>

<script setup>
import {Link} from "@inertiajs/vue3";
import UserMenuHeader from "@/Layouts/UserMenuHeader.vue";
import FooterLayout from "@/Layouts/FooterLayout.vue";
</script>

<script>
export default {

    props: [
        'country',
    ]
}
</script>
