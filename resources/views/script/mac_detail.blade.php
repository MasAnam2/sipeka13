<script>
  function detail(id, url, size='default'){
    mac_preloader_md.css('backgroundColor', bg).fadeIn('slow');
    console.log(mac_preloader_md);
    setTimeout(function(){
      mac_module_icon_md.find('i').addClass(icon);
      mac_md.css('backgroundColor', bg).fadeIn('slow');
      mac_icon_md.find('i').addClass(icon);
      mac_title_md.text("Detail "+title);
      loadDetail(id, url, size);
    }, 1000);
  }
  function loadDetail(id, url, size='default')
  {
    $.ajax({
      url : url,
      type : 'POST',
      data : {
        id : id,
        _token : csrf_token
      },
      beforeSend : function(xhr){
        mac_loader_md.fadeIn('slow');
      },
      success : function(r){
        if(size!='default'){
          mac_md.addClass('mac-small box-shadow');
        }
        mac_content_md.html(r);
        mac_preloader_md.fadeOut('slow');
        if(size!='default'){
          var height = md.find('.mac-small').height();
          mac_md.css({'top' : '50%', 'marginTop' : '-'+height/2+'px'});
        }
        mac_loader_md.fadeOut('slow');
      },
      statusCode : {
        403 : function(xhr){
          errorMsg('Not Authority');
          mac_close_md.trigger('click');
          mac_preloader_md.fadeOut('slow');
          mac_loader_md.fadeOut('slow');
        },
        500 : function(xhr){
          errorMsg('There is error in server');
          mac_close_md.trigger('click');
          mac_preloader_md.fadeOut('slow');
          mac_loader_md.fadeOut('slow');
        }
      }
    });
  }
  mac_close_md.click(function(){
    mac_md.fadeOut('slow');
    mac_title_md.text('');
    mac_module_icon_md.find('i').attr('class', '');
    mac_icon_md.find('i').attr('class', '');
    mac_content_md.empty();
    mac_md.removeClass('mac-small box-shadow');
    mac_md.css({'top':'5%', 'marginTop':'0px'});
  });
</script>