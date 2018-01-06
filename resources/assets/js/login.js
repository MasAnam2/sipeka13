require('./bootstrap')
var welcome;
var restoreLogin;
$('.login').on('submit', function(e) {
	e.preventDefault();
	hideAlert();
	var $this = $(this),
	$state = $this.find('button > .state');
	$this.addClass('loading');
	$state.html('Authenticating');
	authenticate();
	restoreLogin = function(){
		$state.html('Log in');
		$this.removeClass('ok loading');
		working = false;
	}
	welcome = function(callback){
		setTimeout(function() {
			$this.addClass('ok');
			$state.html('Welcome back!');
			callback();
		}, 1000);
	}
});

$('input').on('focus', function(e){
	hideAlert();
});

window.hideAlert = () => {
	$('.alert').fadeOut();
}

window.authenticate = () => {
	let form = $('form');
	let url = form.attr('action');
	let data = form.serializeJSON();
	axios.post(url, data).then(resp=>{
		welcome(function(){
			window.location = base_url('/login')
		});
	}).catch(err=>{
		$('.alert').html(err.response.data.username).fadeIn();
		restoreLogin();
	});
}