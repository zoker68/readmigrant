<template>
    <Menu as="div" class="relative ml-10">
        <template  v-if="$page.props.auth.user">
            <div>
                <MenuButton
                    class="flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
                    <span class="sr-only">Открыть меню пользователя</span>
                    <img v-if="$page.props.auth.user.avatar"
                         class="h-8 w-8 rounded-full"
                         :src="`/storage/avatar/` + $page.props.auth.user.avatar"
                         alt=""/>
                    <img v-else
                         class="h-8 w-8 rounded-full"
                         src="/storage/avatar/dafault.jpg"
                         alt=""/>
                </MenuButton>
            </div>
            <transition enter-active-class="transition ease-out duration-100"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95">
                <MenuItems
                    class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('profile.edit',$page.props.country?$page.props.country.id:$page.props.auth.user.country_id)" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Ваш профиль</Link>

                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('book.my',$page.props.country?$page.props.country.id:$page.props.auth.user.country_id)" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Ваши книги</Link>

                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('book.contact.index',$page.props.country?$page.props.country.id:$page.props.auth.user.country_id)" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">Ваши запросы/переписки</Link>

                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('logout')"  :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700 w-full text-left']" method="post" as="button">
                            Выйти из аккаунта
                        </Link>
                    </MenuItem>
                </MenuItems>
            </transition>
        </template>
        <template v-else>
            <Link
                :href="route('login')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Войти в аккаунт</Link>
            /
            <Link
                :href="route('register')"
                class="ml-0 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
            >Зарегистрироваться</Link>
        </template>

    </Menu>
</template>

<script>
import {Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "UserMenuHeader",
    components: {MenuItem, Link, MenuItems, Menu, MenuButton},

    props: [
        'auth'
    ]
}
</script>

<style scoped>

</style>
