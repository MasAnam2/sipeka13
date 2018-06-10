const { mix } = require('laravel-mix');
mix
.js('resources/assets/js/app.js', 'public/spk/dist/js')
// .minify('public/spk/dist/js/app.js')
   // .sass('resources/assets/sass/app.scss', 'public/css');
// .styles([
// 	'public/bootstrap/css/bootstrap.min.css',
// 	'public/plugins/font-awesome/4.5.0/css/font-awesome.min.css',
// 	'public/plugins/ionicons/2.0.1/css/ionicons.min.css',
// 	'public/plugins/datatables/dataTables.bootstrap.css',
// 	'public/plugins/select2/select2.min.css',
// 	'public/plugins/datepicker/datepicker3.css',
// 	'public/plugins/fonts/sourcesanspro/v9/css/style.css',
// 	'public/dist/css/AdminLTE.min.css',
// 	'public/dist/css/skins/_all-skins.min.css',
// 	'resources/assets/sass/tambahan.css',
// 	], 'public/spk/dist/css/spk-libraries.css')
// .minify('public/spk/dist/css/spk-libraries.css')
// .scripts([
// 	'public/plugins/jQuery/jquery-2.2.3.min.js',
// 	'public/bootstrap/js/bootstrap.min.js',
// 	'public/plugins/datatables/jquery.dataTables.min.js',
// 	'public/plugins/datatables/dataTables.bootstrap.min.js',
// 	'public/plugins/slimScroll/jquery.slimscroll.min.js',
// 	'public/plugins/select2/select2.full.min.js',
// 	'public/plugins/datepicker/bootstrap-datepicker.js',
// 	'public/plugins/iCheck/icheck.min.js',
// 	'public/plugins/serialize_to_json/jquery.serializejson.js',
// 	'public/dist/js/app.min.js',
// 	'public/dist/js/demo.js',
// 	'public/plugins/input-mask/jquery.inputmask.js',
// 	'public/plugins/input-mask/jquery.inputmask.date.extensions.js',
// 	'public/plugins/input-mask/jquery.inputmask.extensions.js',
// 	], 'public/spk/dist/js/spk-libraries.js')
// .minify('public/spk/dist/js/spk-libraries.js')

// login
// .js('resources/assets/js/login.js', 'public/spk/dist/js')
// .styles([
// 	'public/plugins/font-awesome/4.5.0/css/font-awesome.min.css',
// 	'public/plugins/login/css/normalize.min.css',
// 	'resources/assets/sass/login.css',
// 	], 'public/spk/dist/css/login.css')
// .minify('public/spk/dist/css/login.css')
// .scripts([
// 	'public/plugins/login/js/prefixfree.min.js',
// 	'public/plugins/jQuery/jquery-2.2.3.min.js',
// 	'public/plugins/serialize_to_json/jquery.serializejson.js',
// 	], 'public/spk/dist/js/login-libraries.js')
// .scripts([
// 	'public/spk/dist/js/login-libraries.js',
// 	'public/spk/dist/js/login.js',
// 	], 'public/spk/dist/js/login-fix.js')
// .minify('public/spk/dist/js/login-libraries.js')
// .minify('public/spk/dist/js/login-fix.js')