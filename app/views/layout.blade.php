<!DOCTYPE html>
<html>
    <head>
        <title>QSabe - @yield('title','O que você deseja saber agora?')</title>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" type="image/png" href="/img/icon.png" />
        <!--<link href="http://fonts.googleapis.com/css?family=Ubuntu:400,700,400italic,700italic" rel="stylesheet" type="text/css" />-->
        <link href="/css/bootstrap-wysihtml5.css" rel="stylesheet" type="text/css" />
        <link href="/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/css/qsabe.css" rel="stylesheet" type="text/css" />
        @yield('head')
    </head>
    <body>
        <header>
            <div id="logo">
                <a href="/"><img src="/img/logo.png" width="126" height="32" alt="QSabe" border="0" /></a>
            </div>

            <div class="form-group" id="search">
                <div class="input-group">
                    <input class="form-control" type="search" placeholder="O que você deseja saber agora?" />
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </div>
            </div>

            <a href="javascript:void(0)" class="profile main-profile" id="main-profile">
                <!--<img src="/img/avatar.jpg" width="30" height="30" alt="Profile" /> Edgar -->
            </a>

            <div id="notify">
                <a href="#" class="bt-notify bt-notification"></a>
                <a href="#" class="bt-notify bt-question-alert"></a>
            </div>
        </header>
        
        <div id="menu-usuario">
            
        </div>

        <div id="main">
            @yield('left')
            
            @yield('content')
            
            @yield('right')

        </div>

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="/js/wysihtml5-0.3.0.min.js"></script>
        <script src="/js/jquery-2.1.1.min.js"></script>
        <script src="/js/jquery.placeholder.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/bootstrap3-wysihtml5.js"></script>
        <script src="/locales/bootstrap-wysihtml5.pt-BR.js"></script>
        <script src="/js/highcharts.js"></script>

        <script src="/js/qsabe.js"></script>

        <script>
            $(function() {
                $('input, textarea').placeholder();
            });

            $('#abas a').click(function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            $('.textarea').wysihtml5();
        </script>
    </body>
</html>