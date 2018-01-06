<!DOCTYPE html>
<html>
@include('layouts.head')
<body>
    <div class="loader">
        <div data-role="preloader" data-type="ring"></div>
        <h3></h3>
    </div>
    <div class="menu">
        <div class="menu-header">
            @include('layouts.skin')
            <div class="menu-title">
                <h1>Enterprise Edition</h1>
            </div>
            <div class="menu-setting">
                <button class="cycle-button bg-steel fg-white no-border skin-changer-button" onclick="showCharms('#charmSettings')">
                    <span data-role="hint" data-hint-background="bg-steel" data-hint-color="fg-white" data-hint-mode="2" data-hint="Skins" data-hint-position="bottom" class="mif-palette"></span>
                </button>
            </div>
        </div>
        <div class="menu-body">
            <div class="tile-area">
                <div class="single-tile-group">
                    <div data-role="tile" href="#" onclick="to_hris()" class="tile-large">
                        <div class="tile-content iconic">
                            <i class="icon fa fa-users mif-ani-flash mif-ani-slow" id="mif-library"></i>
                        </div>
                        <span class="tile-label">HRIS</span>
                    </div>
                    <div data-role="tile" class="tile tile-square-x">
                        <div class="tile-content iconic">
                            <span class="icon fa fa-taxi mif-ani-heartbeat" id="mif-organization"></span>
                        </div>
                        <span class="tile-label">Fleet Management</span>
                    </div>
                    <div data-role="tile" class="tile tile-square-x">
                        <div class="tile-content iconic">
                            <span class="icon mif-phone mif-ani-heartbeat" id="mif-organization"></span>
                        </div>
                        <span class="tile-label">Help Desk</span>
                    </div>
                </div>
                <div class="single-tile-group">
                    <div data-role="tile" class="tile-wide">
                        <div class="tile-content iconic">
                            <span class="icon fa fa-question-circle mif-ani-heartbeat" id="mif-truck mif-ani-pass"></span>
                        </div>
                        <span class="tile-label">Marketing Idea</span>
                    </div>
                    <div data-role="tile" class="tile">
                        <div class="tile-content iconic">
                            <span class="icon fa fa-line-chart mif-ani-shuttle" id="mif-user"></span>
                        </div>
                        <span class="tile-label">Finance</span>
                    </div>
                    <div data-role="tile" class="tile">
                        <div class="tile-content iconic">
                            <span class="icon fa fa-shopping-cart mif-ani-flash" id="mif-user"></span>
                        </div>
                        <span class="tile-label">Purchasing</span>
                    </div>
                    <div data-role="tile" class="tile-wide">
                        <div class="tile-content iconic" >
                            <span class="icon mif-sun mif-ani-ring mif-ani-slow" id="mif-bell"></span>
                        </div>
                        <span class="tile-label">Other</span>
                    </div>
                </div>
                <div class="single-tile-group">
                    <div data-role="tile" class="tile">
                        <div class="tile-content iconic" >
                            <span class="icon mif-search mif-ani-vertical" id="mif-steps"></span>
                        </div>
                        <span class="tile-label">Inventory Control</span>
                    </div>
                    <div data-role="tile" class="tile">
                        <div class="tile-content iconic" >
                            <span class="icon fa fa-institution mif-ani-float" id="mif-user-plus"></span>
                        </div>
                        <span class="tile-label">Warehouse</span>
                    </div>
                    <div data-role="tile" class="tile-large">
                        <div class="tile-content iconic" >
                            <span class="icon mif-sun mif-ani-spanner" id="mif-hammer"></span>
                        </div>
                        <span class="tile-label">Other</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var bg;
        function to_hris(){
            $('.menu').fadeOut('slow');
            $('.loader').fadeIn();
            var loader = $('.loader');
            loader.find('h3').text('Redirecting');
            var i = 0;
            setInterval(function(){
                loader.find('h3').append('.');
                if(i==5){
                    loader.find('h3').text('Redirecting');
                    i=0;
                }
                i++;
            }, 200);
            setTimeout(function(){
                window.location = '{{ route('hris') }}';
            }, 5000);
        }
    </script>
    @include('script.set_bg')
    @include('script.random')
    @include('script.tile_background')
</body>
</html>