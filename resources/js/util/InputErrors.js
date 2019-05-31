export default class InputErrors {

    constructor() {
        this.errors = {};
    }

    /**
     * Определяет существование ошибки для данного поля
     *
     * @param {string} field
     *
     * @return {boolean}
     */
    has(field) {
        return this.errors.hasOwnProperty(field);
    }

    /**
     * Определяет существования ошибок
     *
     * @return {boolean}
     */
    any() {
        return Object.keys(this.errors).length > 0;
    }

    /**
     * Возвращает сообщение ошибки для данного поля
     *
     * @param field
     *
     * @return {string}
     */
    get(field) {

        if (this.has(field)) {
            return this.errors[field][0];
        }

        return '';
    }

    /**
     * Записывает новые ошибки
     *
     * @param errors
     */
    record(errors) {

        this.clear();

        this.errors = errors;
    }

    /**
     * Очищает одно или все поля ошибок
     *
     * @param {string|null} field
     */
    clear(field = null) {

        if (field != null) {

            this.errors[field] = null;

            delete this.errors[field];
        } else {
            this.errors = {};
        }
    }
};