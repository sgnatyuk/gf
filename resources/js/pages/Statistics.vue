<template>
    <div class="container">

        <div class="row justify-content-md-center align-items-center">

            <div class="col">
                <table class="table">

                    <thead>
                    <tr>
                        <th>Клиент</th>
                        <th>Заказ</th>
                    </tr>
                    </thead>

                    <tbody>

                    <tr v-for="item in statistics">

                        <td><b>{{ item.name }}</b> <br> {{ item.phone }}</td>

                        <td>
                            <ul class="list-group">
                                <li class="list-group-item" v-for="order in item.orders">
                                    <b>Тариф:</b> {{ order.tariff_name }},
                                    <b>адрес:</b> {{ order.address }},
                                    <b>дней:</b> {{ order.amount_days }}
                                </li>
                            </ul>
                        </td>

                    </tr>

                    </tbody>

                </table>
            </div>

        </div>

    </div>
</template>

<script>

    export default {
        created() {
            this.$http
                .get('getStatistics')
                .then(response => this.statistics = response.data.data);

        },
        data() {
            return {
                statistics: [],
            };
        },
    };
</script>

<style lang="scss" scoped>
    .row {
        min-height: 100vh;
    }
</style>