<template>

    <main>
        <ul class="nav fixed-top">
            <li class="nav-item">
                <router-link
                        class="nav-link"
                        :to="{ name: 'home' }">Главная
                </router-link>
            </li>
            <li class="nav-item">
                <router-link
                        class="nav-link"
                        :to="{ name: 'statistics' }">Статистика
                </router-link>
            </li>
        </ul>

        <router-view></router-view>
    </main>

</template>

<script>
    export default {};
</script>

