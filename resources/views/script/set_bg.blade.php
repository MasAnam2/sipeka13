<script>
    var current_bg = localStorage.getItem('bg') || 'bg-blue';
    $('body').addClass(current_bg);
    $(".schemeButtons .button").hover(
        function(){
            bg = "bg-" +  $(this).data('scheme');
            $("body").attr('class', '').addClass(bg);
        },
        function(){
            $("body").attr('class', '').addClass(current_bg);
        });
    $(".schemeButtons .button").on("click", function(){
        bg = "bg-" +  $(this).data('scheme');
        $('body').attr('class', '').addClass(bg);
        localStorage.setItem('bg', bg);
        current_bg = bg;
    });
</script>