<template>

    <div class="container">
        <div class="row justify-content-md-center align-items-center">
            <div class="col-md-6 col-xs-12">

                <div :class="['alert alert-dismissible fade', 'alert-' + alertState.status , {'show': alertState.status}]">

                    {{ alertState.text }}

                    <button
                            type="button"
                            class="close"
                            @click="alertState = {status: false, text: null}"
                    >
                        &times;
                    </button>
                </div>

                <div class="form-group">
                    <label for="name">ФИО</label>
                    <input
                            type="text"
                            :class="['form-control', {'is-invalid': errors.has('name')}]"
                            id="name"
                            @click="errors.clear('name')"
                            v-model="data.name"
                    >
                    <div class="invalid-feedback">{{ errors.get('name') }}</div>
                </div>

                <div class="form-group">

                    <label for="phone">Телефон</label>

                    <div class="input-group">

                        <div class="input-group-prepend">
                            <div class="input-group-text">+7</div>
                        </div>

                        <input
                                type="tel"
                                :class="['form-control', {'is-invalid': errors.has('phone')}]"
                                id="phone"
                                autocomplete="tel"
                                maxlength="14"
                                v-phone
                                pattern="[(][0-9]{3}[)] [0-9]{3}-[0-9]{4}"
                                @click="errors.clear('phone')"
                                v-model="data.phone"
                        >
                        <div class="invalid-feedback">{{ errors.get('phone') }}</div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="address">Адрес</label>
                    <textarea
                            :class="['form-control', {'is-invalid': errors.has('address')}]"
                            id="address"
                            @click="errors.clear('address')"
                            v-model="data.address"
                    ></textarea>
                    <div class="invalid-feedback">{{ errors.get('address') }}</div>
                </div>

                <div class="form-group">
                    <label for="tariff">Тариф</label>
                    <select
                            :class="['form-control', {'is-invalid': errors.has('tariff_id')}]"
                            id="tariff"
                            @click="errors.clear('tariff_id')"
                            v-model="data.tariff_id"
                    >

                        <option :value="null" disabled>Не выбран</option>

                        <option
                                v-for="tariff in tariffs"
                                :value="tariff.id"
                        >
                            {{ tariff.name }}
                        </option>

                    </select>

                    <div class="invalid-feedback">{{ errors.get('tariff_id') }}</div>

                    <small
                            class="form-text text-muted"
                            v-show="data.tariff_id"
                    >
                        {{ tariffDescription }}
                    </small>
                </div>

                <div v-show="data.tariff_id">

                    <Datepicker
                            id="first_day"
                            :disabled_days="disabledDays"
                            :error="errors.get('first_day')"
                            v-model="data.first_day">Первый день доставки
                    </Datepicker>

                    <p>Доступные дни:</p>

                    <ul>
                        <li v-for="day in enabledDays">{{ day }}</li>
                    </ul>

                </div>

                <div class="form-group">

                    <p>Количество дней</p>

                    <div class="form-inline" v-for="count in days">

                        <div class="form-check form-check-inline">
                            <input
                                    type="radio"
                                    class="form-check-input"
                                    :id="`cd-${count}`"
                                    :value="count"
                                    v-model="data.amount_days">

                            <label :for="`cd-${count}`" class="form-check-label">{{ count }}</label>
                        </div>

                    </div>
                </div>

                <p v-show="total"><b>Итого:</b> {{ total }}</p>

                <button
                        type="button"
                        class="btn btn-primary"
                        @click="onSubmit"
                >
                    Отправить
                </button>

            </div>
        </div>
    </div>

</template>

<script>

    import InputErrors from '../util/InputErrors';
    import Datepicker from '../componets/Datepicker';

    const daysOfWeek = [
        'Воскресение',
        'Понедельник',
        'Вторник',
        'Среда',
        'Четверг',
        'Пятница',
        'Суббота',
    ];

    export default {
        created() {
            this.$http
                .get('getTariffs')
                .then(response => this.tariffs = response.data.data);

        },
        components: {
            Datepicker,
        },
        data() {
            return {
                errors: new InputErrors,
                alertState: {
                    status: null,
                    text: null,
                },
                data: {
                    name: null,
                    phone: null,
                    address: null,
                    tariff_id: null,
                    first_day: null,
                    amount_days: 6,
                },
                tariffs: [],
                days: [6, 12, 24],
            };
        },
        computed: {
            currentTariff() {

                if (this.data.tariff_id === null)
                    return null;

                return this.tariffs.find(tariff => tariff.id === this.data.tariff_id);
            },

            tariffDescription() {

                if (this.currentTariff === null)
                    return null;

                return `${this.currentTariff.description} (${this.currentTariff.price} руб.)`;
            },
            total() {

                if (this.currentTariff === null)
                    return null;

                let total = this.currentTariff.price * this.data.amount_days;

                return `${total} руб.`;
            },
            disabledDays() {

                if (this.currentTariff === null)
                    return [0, 1, 2, 3, 4, 5, 6]; // Все дни

                return this.currentTariff.disabled_days;
            },
            enabledDays() {
                return daysOfWeek.filter((item, index) => (!this.disabledDays.includes(index)));
            },
        },
        methods: {
            onSubmit() {

                this.$http
                    .post('confirm', this.data)
                    .then(response => {

                        this.alertState = {
                            status: 'success',
                            text: response.data.message,
                        };

                        this.errors.clear();
                    })
                    .catch(error => {

                        if (error.response.status === 422) {
                            this.errors.record(error.response.data.errors);
                        } else {

                            this.alertState = {
                                status: 'danger',
                                text: error.response.data.message,
                            };

                            this.errors.clear();
                        }
                    });
            },
        },
    };
</script>

<style lang="scss" scoped>
    .row {
        height: 100vh;
    }
</style>