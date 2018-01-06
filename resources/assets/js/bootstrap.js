
// window._ = require('lodash');
try {
    // window.$ = window.jQuery = require('jquery');

    // require('bootstrap-sass');
} catch (e) {}

window.axios = require('axios');
const token = document.getElementById('csrf-token')
window.csrf_token = token.content
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const BASE_URL = document.querySelector('[name="base-url"]').content
window.base_url = (uri = '') => {
	return BASE_URL + uri
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
