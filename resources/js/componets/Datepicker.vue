<template>

    <div class="form-group">

        <label :for="id">
            <slot></slot>
        </label>

        <input
                type="text"
                :class="['form-control', {'is-invalid': error}]"
                :ref="id"
                :id="id"
                :value="value"
                @click="clearError"
                @keyup.enter="enter"
        >
        <div class="invalid-feedback">{{ error }}</div>
    </div>

</template>

<script>

    require('air-datepicker/dist/css/datepicker.min.css');
    require('air-datepicker/dist/js/datepicker.min.js');

    export default {
        mounted() {

            let vm = this;

            this.instance = $(this.$refs[this.id]);

            this.instance.datepicker({
                minDate: new Date,
                onSelect(fd) {
                    vm.$emit('input', fd);
                },
                onRenderCell(date, cellType) {
                    if (cellType === 'day') {

                        let day = date.getDay(),
                            isDisabled = vm.disabled_days.indexOf(day) !== -1;

                        return {
                            disabled: isDisabled,
                        };
                    }
                },
            });

        },
        destroyed() {

            try {
                if (!this.destroyed) {

                    this.instance.destroy();

                    this.destroyed = true;
                }
            } catch (e) {
            }
        },
        props: {
            value: {},
            id: {
                type: String,
                required: true,
            },
            error: {
                type: String,
                required: false,
                default: '',
            },
            disabled_days: {
                type: Array,
                return() {
                    return [];
                },
            },
        },
        data() {
            return {
                instance: null,
                destroyed: false,
            };
        },
        methods: {
            handle(event) {
                this.$emit('input', event.target.value);
            },
            enter() {
                this.$emit('enter');
            },
            clearError() {
                this.$emit('clearError');
            },
        },
        watch: {
            disabled_days: {
                handler(value) {

                    if (!this.instance)
                        return;

                    let datepicker = this.instance.datepicker().data('datepicker');

                    datepicker.update({
                        onRenderCell(date, cellType) {
                            if (cellType === 'day') {

                                let day = date.getDay(),
                                    isDisabled = value.indexOf(day) !== -1;

                                return {
                                    disabled: isDisabled,
                                };
                            }
                        },
                    });
                },
                immediate: true,
            },
        },
    };
</script>