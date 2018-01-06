// CONTENT VIEW

window.BAR_LOADER = `<section class="content"><div class="row"><div class="col-md-12"><div class="box"><div class="box-body"><div class="progress active"><div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">40% Complete (success)</span></div></div></div></div></div></div></section>`


window.showFailedAlert = (errorTxt, el='.failed-alert') => {
	let eee;
	$(el).find('p').html(errorTxt);
	$(el).fadeIn();
	clearTimeout(eee);
	eee = setTimeout(function(){
		$(el).fadeOut();
	}, 5000);
}


window.showSuccessAlert = (successTxt, el='.success-alert') => {
	let sss;
	$(el).find('p').html(successTxt);
	$(el).fadeIn();
	clearTimeout(sss);
	sss = setTimeout(function(){
		$(el).fadeOut();
	}, 5000);
}

window.moveModul = (uri, title, modul) => {
	const content          = $('.content-wrapper');
	content.html(BAR_LOADER)
	const url        = base_url(uri)
	document.title = title;
	window.history.pushState('', modul, url);
	axios.get(url, {
		onDownloadProgress : function(progressEvent){
			var percentCompleted = Math.floor((progressEvent.loaded * 100) / progressEvent.total);
			content.find('[role="progressbar"]').attr('aria-valuenow', percentCompleted).css('width', percentCompleted+'%')
		}
	}).then((resp) =>{
		setTimeout(function(){
			content.replaceWith(resp.data);
			setTimeout(()=>{
				datatableRender();
				pluginsRender();
				salariesCallback()
				$.AdminLTE.layout.activate();
			}, 1000)
		}, 2000)
	}).catch((err) => {
		handleError(err)
	});
}

window.pluginsRender = () => {
	if(!$('.real-time').length>0)
		$('.breadcrumb').prepend('<li class="real-time"></li>');
	renderTimer();
	$(".select2").select2({
		tags : true
	});
	$('#filter_date_salaries').datepicker({
		autoclose: true,
		format : 'yyyy-mm'
	})
	$('.datepicker').datepicker({
		autoclose: true,
		format : 'yyyy/mm/dd'
	})
	$('[data-toggle="tooltip"]').tooltip();
	$('[data-select="status"]').trigger('change');
	iCheckRender();
	enterEvent();
	eventMoneyInput();
}

window.random = (min, max) => {
	return Math.floor(Math.random() * (max - min) ) + min;
}

window.iCheckRender = () => {
	$('.icheck').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass: 'iradio_minimal-blue'
	});
	checkAll();
	unCheckAll();
	if($('[data-menu="member"]').length>0)
		accountEvent();
	$('[data-check="check-member"]').on('ifChanged', function(){
		toggleDeleteSelected();
	});
}

window.enterEvent = () =>  {
	$('input[type="text"].form-control, input[type="password"].form-control').on('keyup', function(e){
		e.preventDefault();
		let f = $(this).parents('form');
		if(e.keyCode == 13)
			f.find('#save').trigger('click');
	});
	$('textarea.form-control').on('keyup', function(e){
		e.preventDefault();
		let f = $(this).parents('form');
		if(e.keyCode == 13 && e.ctrlKey == true)
			f.find('#save').trigger('click');
	});
	$('input[type="text"].form-control').parents('form').on('submit', function(e){
		e.preventDefault();
	});
}

window.eventMoneyInput = () => {
	$('.numeric-only').on('keydown', function(e){
		numericOnly(this, e);
	});
}

window.numericOnly = (el, e) => {
	var k = e.key;
	var allow = ['Tab', 'Backspace', 'Delete', 'ArrowLeft', 'ArrowRight'];
	if($(el).val().includes('.')){
		if(!(k>=0 && k<=9) && $.inArray(k, allow)<0 && !(e.keyCode == 65 && e.ctrlKey)) {
			e.preventDefault();
		}
	}else{
		if(!(e.key>=0 && e.key<=9) && $.inArray(k, allow)<0 && e.key != '.' && !(e.keyCode == 65 && e.ctrlKey)) {
			e.preventDefault();
		}
	}
}

window.resetSelect = (form) => {
	var sel = form.find('select');
	var opt;
	sel.each(function(){
		optArr = [];
		$(this).find('option').each(function(){
			optArr.push($(this).attr('value'));
		});
		$(this).val(random(0, optArr.length)).trigger('change').val(optArr[0]).trigger('change');
	});
}

window.addSelectAllCheckbox = () => {
	$('#datatable').find('th:first').before('<th width="10px"><input type="checkbox" class="minimal icheck" data-check="check-all"></th>')
}

window.TABLE = null

window.datatableRender = () => {
	addSelectAllCheckbox();
	const dt_url = $('#datatable').data('url');
	TABLE = $('#datatable').DataTable({
		ajax : {
			url : dt_url,
			type : 'POST',
			data : {
				_token : csrf_token
			}
		},
		responsive : true
	});

	$('#datatable').on('draw.dt', function(){
		iCheckRender();
		toggleDeleteSelected()
	});
}

window.checkAll = () => {
	$('[data-check="check-all"]').on('ifChecked', function(event){
		$('[data-check="check-member"]').iCheck('check');
	});
}

window.unCheckAll = () => {
	$('[data-check="check-all"]').on('ifUnchecked', function(event){
		$('[data-check="check-member"]').iCheck('uncheck');
	});
}

window.toggleDeleteSelected = () => {
	if($('[data-check="check-member"]:checked').length>0){
		$('.delete-button-selected').fadeIn();
	}else{
		$('.delete-button-selected').fadeOut();
		$('[data-check="check-all"]').iCheck('uncheck');
	}
}

window.statusEvent = (el) => {
	if($(el).val()==0){
		$(el).parents('form').find('.attendance-time').show();
		$(el).parents('form').find('.attendance-information').hide();
	}else{
		$(el).parents('form').find('.attendance-time').hide();
		$(el).parents('form').find('.attendance-information').show();
	}
}

window.uncheckAll = () => {
	$('.check-menu').prop('checked', false);
}

window.showModal = () => {
	$('#freeModal').modal('show');
	pluginsRender();
}

window.disable = (id) => {
	const confir = confirm('Are you sure?');
	if(confir){
		$('#dis-id').val(id);
		$('#dis-form').submit();
	}
}

window.resetError = (el)=> {
	el = $(el).next().find('strong');
	el.empty();
	$(el).parents('.form-group').removeClass('has-error');
}

window.reset = (id) => {
	var confir = confirm('Anda yakin?');
	if(confir){
		$('#id2').val(id);
		$('#reset').submit();
	}
}
window.enable = (id) => {
	var confir = confirm('Are you sure?');
	if(confir){
		$('#enable_id').val(id);
		$('#enable').submit();
	}
}
window.reset2 = () => {
	var confir = confirm('Anda yakin?');
	if(confir){
		$('#reset2').submit();
	}
}
window.logout = () => {
	$('#logout').submit();
}
window.profile = () => {
	$('#profileModal').modal();
}
window.avatar = () => {
	$('#avatarModal').modal();
}
window.pass = () => {
	$('#passwordModal').modal();
}
window.checkimage = (v) => {
	if(v!='' && !(v.includes('.png') || v.includes('.jpg'))){
		alert('Must .png or .jpg');
		$('#avatar').val("");
	}
}

window.refreshTable = () => {
	window.TABLE.ajax.reload();
}

window.renderTimer = () => {
	let checkTime = function(i){
		if (i < 10) {i = "0" + i};
		return i;
	}
	let weekday   = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
	let month     = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	let today     = new Date();
	let n         = weekday[today.getDay()];
	let h         = today.getHours();
	let m         = today.getMinutes();
	let s         = today.getSeconds();
	m             = checkTime(m);
	s             = checkTime(s);
	$('.real-time').html('<i class="fa fa-clock-o"></i> '+n+', '+month[today.getMonth()]+' '+today.getDate()+' '+today.getFullYear()+' '+h + ":" + m + ":" + s);
	setTimeout(renderTimer, 500);
}

window.triggered = (selector, onEvent) => {
	$(selector).trigger(onEvent);
}


$(document).ready(function () {
	datatableRender()
	pluginsRender();
	$('[data-select="status"]').trigger('change');
	$(".date-mask").inputmask();
	salariesCallback()
	$(window).on('resize', function(e){
		$.AdminLTE.layout.activate();
	})
	$('#check-all').on('ifChecked', function(event){
		$('.check-menu').iCheck('check');
	});
	$('#check-all').on('ifUnchecked', function(event){
		$('.check-menu').iCheck('uncheck');
	});
	$('.attendance-status').on('change', function(){
		if($(this).val()=='1'){
			$(this).parents('form').find('.attendance-time').show();
			$(this).parents('form').find('.attendance-information').hide();
		}else{
			$(this).parents('form').find('.attendance-time').hide();
			$(this).parents('form').find('.attendance-information').show();
		}
	})

	if($('.attendance-status').length>0){
		$('.attendance-status').trigger('change');
	}
	$("[data-mask]").inputmask();

})

// AJAX

window.MENYIMPAN = false

window.save = (el, e, action='insert', close=false) => {
	if(!window.MENYIMPAN){	
		window.MENYIMPAN = true
		e.preventDefault()
		resetAllError()
		let form = $(el)
		let button = $(el).attr('id')=='save' || $(el).attr('id')=='save-close'
		if(button){
			form = $(el).parents('form')
		}
		const url = form.attr('action')
		if(button){
			button = $(el)
		}else{
			button = form.find('#save')
		}
		const saveBtn = form.find('#save')
		const saveCloseBtn = form.find('#save-close')
		saveBtn.addClass('disabled').text('Saving')
		saveCloseBtn.addClass('disabled').text('Saving')
		const file = form.find('[type="file"]')
		let err = false;
		file.each(function(key, value){
			if($(value).data('required')=='required' && $(value).val()==''){
				showFailedAlert($(value).attr('name')+' required', alertElement);
				err = true;
			}
		});
		if(err){
			return;
		}
		let data = new FormData(form[0]);
		axios.post(url, data).then((res) => {
			if(action=='insert'){
				resetForm(form)
			}
			refreshTable();
			if(close)
				$('#freeModal').modal('hide');
			calloutSuccess(res.data)
			saveBtn.removeClass('disabled').text('Save')
			saveCloseBtn.removeClass('disabled').text('Save & Close')
			window.MENYIMPAN = false
		}).catch((err)=>{
			handleError(err, form)
			saveBtn.removeClass('disabled').text('Save')
			saveCloseBtn.removeClass('disabled').text('Save & Close')
			window.MENYIMPAN = false
		});
	}
}

window.resetForm = (form) => {
	form.find('[type="text"], [type="number"], [type="file"], [type="email"], [type="password"], select[multiple], textarea').val('')
	form.find('[type="checkbox"], [type="radio"]').iCheck('uncheck')
	form.find('[multiple]').val('').trigger('change');
	if(form.find('[data-default-value]').length>0){
		let input = form.find('[data-default-value]');
		input.each(function(el){
			$(this).val($(this).data('default-value'));
		});
	}
	resetSelect(form)
}

window.update = (e, el, formId, callback = null) => {
	resetAllError()
	e.preventDefault()
	e.stopPropagation()
	if(!window.MENYIMPAN){
		window.MENYIMPAN = true
		$('#'+formId).find('#simpan-btn').addClass('disabled').text('Saving')
		const url = $(el).attr('action')
		const data = new FormData(document.getElementById(formId)) 
		const config = {
			headers : {
				'Content-Type' : 'multipart/form-data'
			}
		}
		axios.post(url, data, config).then(res=>{
			window.MENYIMPAN = false
			$('#'+formId).find('#simpan-btn').removeClass('disabled').text('Save changes')
			calloutSuccess(res.data)
			if(callback)
				callback()
		}).catch(err=>{
			window.MENYIMPAN = false
			$('#'+formId).find('#simpan-btn').removeClass('disabled').text('Save changes')
			handleError(err, '#'+formId)
		})	
	}
	return false
}

window.companyEdit = (e) => {
	e.preventDefault();
	const url = base_url('/company-profile/edit')
	axios.get(url).then(res=>{
		$('#company-modal-edit').find('.modal-body').html(res.data)
		$('#company-modal-edit').modal()
	}).catch(err=>{
		alert('failed to load')
	})
}

window.updateCompanyProfile = (e, el) => {
	return update(e, el, 'company-modal-edit-form', refreshCompanyProfile)
}

window.refreshCompanyProfile = () => {
	$('#company-profile-view').html('<h3>REFRESHING</h3>')
	axios.get(base_url('/company-profile/view')).then(res=>{
		$('#company-profile-view').html(res.data)
	}).catch(err=>{
		$('#company-profile-view').html("ERROR")
	})
	axios.get(base_url('/company-profile/data')).then(res=>{
		$('.company-title').html(res.data.name)
	}).catch(err=>{
		$('.company-title').html("ERROR")
	})
}

window.calloutDanger = (text) => {
	$('#callout-danger').fadeIn()
	$('#callout-danger').find('p').html(text)
	setTimeout(() => {
		$('#callout-danger').fadeOut()
	}, 3000)
}

window.calloutSuccess = (text) => {
	$('#callout-success').fadeIn()
	$('#callout-success').find('p').html(text)
	setTimeout(() => {
		$('#callout-success').fadeOut()
	}, 3000)
}

window.handleError = (err, form) => {
	if(err.response.status == 409)
		calloutDanger(err.response.data)
	else if(err.response.status == 422){
		calloutDanger('Error occured!!!<br>Please check again field in form')
		let errors = err.response.data.errors ? err.response.data.errors : err.response.data
		let input;
		for(let key in errors){
			$(form).find('#'+key).parents('.form-group').addClass('has-error').find('strong').html(errors[key][0])
		}
	}else if(err.response.status == 404){
		calloutDanger('URL NOT FOUND')
	}else if(err.response.status == 500){
		calloutDanger('THERE IS ERROR IN SERVER')
	}else if(err.response.status == 401){
		calloutDanger('YOUR SESSION EXPIRED. PLEASE LOGIN AGAIN. REDIRECT IN 3S')
		setTimeout(()=>{
			window.location = base_url('/login')
		}, 3000)
	}
}

window.editAvatar = (e) => {
	e.preventDefault()
	$('#avatarModal').modal()
}

window.updateAvatar = (e, el) => {
	update(e, el, 'change-avatar-form', refreshAvatar)
	return false
}

window.refreshAvatar = () => {
	axios.get(base_url('/profile/avatar-leftbar')).then(res=>{
		$('#avatar-leftbar').html(res.data)
	})
	axios.get(base_url('/profile/avatar-image')).then(res=>{
		$('.user-header').find('img').attr('src', res.data)
		$('.widget-user-image').find('img').attr('src', res.data)
		$('.user-image').attr('src', res.data)
	})
}

window.resetAllError = () => {
	$('.form-group').removeClass('has-error')
	$('span.help-block').find('strong').empty()
}

// SALARIES
window.checkSalary = (el) => {
	const form           = $(el).parents('form');
	const employee       = form.find('#employee').val();
	const month          = form.find('#month').val();
	const year           = form.find('#year').val();
	const salary_content = form.find('.salary-content');
	salary_content.html(BAR_LOADER)
	axios.post(base_url('/salary/check'), {
		employee : employee,
		month : month,
		year : year
	}, {
		onDownloadProgress(pe){
			const percentCompleted = Math.floor((pe.loaded * 100) / pe.total);
			salary_content.find('[role="progressbar"]').attr('aria-valuenow', percentCompleted).css('width', percentCompleted+'%')
		}
	}).then(resp=>{
		setTimeout(()=>{
			salary_content.html(resp.data);
			iCheckRender()
		}, 2000)
	})
}

window.salariesCallback = () => {
	if(window.location.pathname.includes('salaries')){
		$('#employee').trigger('change')
	}	
}

window.setClearSalary = (el, event) => {
	numericOnly(el, event);
	let form             = $(el).parents('form');
	let basic_salary     = Number(form.find('#basic_salary').val());
	console.log(form.find('#basic_salary').val())
	let allowance        = Number(form.find('#allowance').val());
	let eat_cost         = Number(form.find('#eat_cost').val());
	let transportation   = Number(form.find('#transportation').val());
	let result_over_time = Number(form.find('#over_time_total').val());
	let loan             = Number(form.find('#loan').val());
	let thr              = Number(form.find('#thr').val());
	let reward           = Number(form.find('#reward').val());
	let punishment       = Number(form.find('#punishment').val());
	let clear            = ((basic_salary+allowance+eat_cost+transportation+thr+reward+result_over_time)-(punishment));
	if($('input[name="withLoan"]').val() == 'true'){
		clear -= loan;
	}
	form.find('[data-clear-salary]').val(clear);
}

window.c = (el) => {
	console.log($(el).prop('checked'));
}

window.deleteSelected = (el) => {
	let conf = confirm('Are you sure?');
	if(conf){
		let form   = $(el).parents('form');
		let data   = form.serializeJSON();
		let url    = form.attr('action');
		let config = {
			data : data
		};
		axios.delete(url, config)
		.then(response=>{
			calloutSuccess(response.data);
			refreshTable();
		}).catch(err=>{
			handleError(err)
		});
	}
}

window.edit = (id, url, modul, size='') => {
	$.ajax({
		url : url,
		data : {
			id : id,
			_token : csrf_token
		},
		type : 'POST',
		success : function(response){
			modalSetup(modul+' Edit', response, size);
			showModal();
		}
	});
}

window.detail = (id, url, modul, size='') => {
	$.ajax({
		url : url,
		data : {
			id : id,
			_token : csrf_token
		},
		type : 'POST',
		success : function(response){
			modalSetup(modul+' Detail', response, size);
			showModal();
		}
	});
}

window.FULL_ALERT = '<div class="row"><div class="col-md-12"><div class="callout callout-success success-alert2" style="display: none;"><h4>Success :)</h4><p></p></div></div><div class="col-md-12"><div class="callout callout-danger failed-alert2" style="display: none;"><h4>Failed!</h4><p></p></div></div></div>'

window.modalSetup = (title, content, size) => {
	$('#freeModal').find('.modal-dialog').removeClass('modal-sm modal-lg');
	$('#freeModal').find('.modal-header').find('h4').text(title);
	$('#freeModal').find('.modal-body').html(content);
	$('#freeModal').find('.modal-dialog').addClass(size);
	$('#freeModal').find('form').prepend(FULL_ALERT);
}

window.remove = (id, url) => {
	let confir = confirm('Are you sure?');
	const config = {
		data : {
			id : id,
			_token : csrf_token
		}
	}
	if(confir){
		axios.delete(url, config)
		.then(resp=>{
			calloutSuccess(resp.data);
			refreshTable();
		})
		.catch(err=>{
			handleError(err)
		});
	}
}

window.filterAttendance = (selector) => {
	let time = $(selector).val();
	if(selector == '#filter-date'){
		if(time){
			time = time.replace('/', '-')
			time = time.replace('/', '-')
			moveModul('/attendance/filter/'+time, 'Attendances '+time);
		}else{
			alert('filter date cannot empty')
			return
		}
	}else{
		if(time!='all')
			moveModul('/attendance/filter/'+time, 'Attendances '+selector.options[selector.selectedIndex].text);
		else
			moveModul('/attendances', 'Attendances');
	}
}

window.filterOverTime = (selector) => {
	let time = $(selector).val();
	if(selector == '#filter-date'){
		if(time){
			time = time.replace('/', '-')
			time = time.replace('/', '-')
			moveModul('/over_time/filter/'+time, 'Over Time '+time);
		}else{
			alert('filter date cannot empty')
			return
		}
	}else{
		if(time!='all')
			moveModul('/over_time/filter/'+time, 'Over Time '+selector.options[selector.selectedIndex].text);
		else
			moveModul('/over_times', 'Over Time');
	}
}

window.filterSalaries = () => {
	let date = $('#filter_date_salaries').val().toString()
	if(!date.trim()){
		alert('Filter Period (Year - Month)')
		return
	}
	moveModul('/salaries/filter/'+date, 'Salaries '+date)
}