import axios from 'axios';

const baseURL = 'https://handsfree.su/api/';

const http = axios.create({
    baseURL,
    headers: {
        common: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute('content'),
        },
    },
});

export default http;