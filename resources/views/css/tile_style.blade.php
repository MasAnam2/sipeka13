<style>
    body{
        /*overflow-x: scroll;*/
        overflow-y: hidden;
    }
    .menu{
        width: auto;
        height: 100%;
    }
    .menu-header{
        height: 100px;
    }
    .menu-title{
        width: 40%;
        float: left;
    }
    .menu-title h1{
        margin-top: 30px;
        margin-left: 30px;
        color: white;
    }
    .menu-setting{
        float: right;
        width: 60%;
    }
    .menu-body{
        width: auto;
    }
    .tile-area{
        width: auto;
        padding: 0 0 0 40px;
        overflow-x: auto;
        overflow-y: hidden;
        max-height: 100%;
    }
    .setting{
        float: right;
        margin-right: 30px;
        margin-top: 30px;
    }
    .skin-changer-button{
        float: right;
        margin-right: 30px;
        margin-top: 30px;
    }
    
    {{
        '
        @media screen and (max-width: 1920px){
            .single-tile-group{
                width: 600px;
                float: left;
            }
            .double-tile-group{
                width: 1000px;
                float: left;
            }
            .tile-large{
                width: 560px;
                height: 560px;
            }
            .tile{
                width: 275px;
                height: 275px;
            }
            .tile-wide{
                width: 560px;
                height: 275px;
            }
            .tile-content .icon{
                font-size: 120px !important;
                margin-top: -60px !important;
                margin-left: -60px !important;
            }
        }
        @media screen and (max-width: 1600px){
            .single-tile-group{
                width: 500px;
                float: left;
            }
            .double-tile-group{
                width: 1000px;
                float: left;
            }
            .tile-large{
                width: 460px;
                height: 460px;
            }
            .tile{
                width: 225px;
                height: 225px;
            }
            .tile-wide{
                width: 460px;
                height: 225px;
            }
            .tile-content .icon{
                font-size: 100px !important;
                margin-top: -50px !important;
                margin-left: -50px !important;
            }
        }
        @media screen and (max-width: 1366px){
            .single-tile-group{
                width: 400px;
                float: left;
            }
            .double-tile-group{
                width: 900px;
                float: left;
            }
            .tile-wide{
                width: 310px;
                height: 150px;
            }
            .tile-large{
                width: 310px;
                height: 310px;
            }
            .tile{
                width: 150px;
                height: 150px;
            }
            .tile-content .icon {
                font-size: 64px !important;
                margin-top: -32px !important;
                margin-left: -32px !important;
            }
        }
        '.
        '@media screen and (max-width: 1024px){
            .single-tile-group{
                width: 330px;
                float: left;
            }
            .double-tile-group{
                width: 800px;
                float: left;
            }
            .tile-area{
                width: auto;
                padding: 0 0 0 20px;
                overflow-x: auto;
                overflow-y: hidden;
                max-height: 100%;
            }
            .tile-large{
                width: 290px;
                height: 290px;
            }
            .tile{
                width: 140px;
                height: 140px;
            }
            .tile-wide{
                width: 290px;
                height: 140px;
            }
        }'
    }}
</style>