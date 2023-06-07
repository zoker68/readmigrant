<template>
    <Head title="Выберите страну нахождения"/>

    <div class="bg-white">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Выберите страну</h2>

        <div class="grid grid-cols-1 gap-x-6 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 max-w-100">
            <div v-for="country in countries" class="group w-56">

                <div class="mt-2">
                    <h3 class="text-gray-800 text-center">
                        <Link :href="route('book.index',country.id)">
                            <span aria-hidden="true" class="inset-0"/>
                            {{ country.title }}
                        </Link>
                    </h3>
                </div>
                <div class="group-hover:opacity-75">
                    <Link :href="route('book.index',country.id)">
                        <img :src="`images/country/flag/image/${country.id}.png`" :alt="country.title"
                             class="border-2 h-36 w-56"/>
                    </Link>
                </div>
            </div>
        </div>
    </div>
    <div class="mx-auto mt-3 max-w-7xl py-6 rounded-3xl ring-1 ring-gray-200">
        <section>
            <div class=" sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-xl">Ваш источник вдохновения и обмена
                    книгами</h2>
                <p class="mt-4 text-gray-500">ReadMigrant - это платформа, которая объединяет любителей чтения и
                    предлагает уникальную возможность временного обмена книгами с другими участниками сообщества.</p>

                <p class="mt-4 text-gray-500">У нас вы сможете найти новые увлекательные книги и поделиться своими
                    сокровищами мировой литературы. Вы можете временно обменяться своими любимыми экземплярами с другими
                    членами нашего сообщества.</p>

                <p class="mt-4 text-gray-500">Мы верим, что книги имеют особую силу, способную пробуждать в нас новые
                    идеи, погружать в другие миры и расширять наши горизонты. Через временный обмен книгами на
                    ReadMigrant вы можете не только насладиться чтением новых произведений, но и установить ценные
                    контакты с другими книголюбами, обсудить прочитанное и разделить свои впечатления.</p>

                <p class="mt-4 text-gray-500">Присоединяйтесь к нашему сообществу, где мы вместе создаем уникальную
                    атмосферу обмена книгами и вдохновляющих литературных открытий.</p>
            </div>
        </section>

        <section>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-xl">О нас</h2>
                <p class="mt-4 text-gray-500">Я энтузиаст, который разделяют любовь к чтению и стремится
                    создать дружелюбное и вдохновляющее онлайн-сообщество. Моя цель - сделать чтение доступным и
                    увлекательным, а также позволить людям делиться своими любимыми книгами, обмениваться опытом и
                    находить новых друзей с общими интересами.</p>
            </div>
        </section>

        <section>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-xl">Обмен книгами</h2>
                <p class="mt-4 text-gray-500">Чтобы начать обмен книгами, просто создайте аккаунт на нашем сайте,
                    загрузите информацию о доступных
                    книгах или найдите интересующие вас книги других участников. Мы поощряем взаимовыгодные обмены и
                    помогаем создавать ценные литературные связи.</p>
            </div>
        </section>

        <section>
            <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-xl">Свяжитесь с нами</h2>
                <p class="mt-4 text-gray-500">Если у вас есть вопросы, предложения или пожелания, не стесняйтесь
                    связаться с нами. Мы всегда готовы помочь и выслушать вас.</p>
            </div>
        </section>
    </div>
</template>

<script setup>
import SelectCountry from "@/Layouts/SelectCountry.vue";
import {Head, Link} from "@inertiajs/vue3";
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
