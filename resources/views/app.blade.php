<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
    <!-- Created by Zander -->
    <!-- Contact http://zandervdm.nl -->
    <!-- Available for free @ https://github.com/Taronyuu/Minecraft-SRV -->
    <!-- Do not remove this! -->

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Minecraft - DNS</title>
    <meta name="description" content="MCPlay.pw is a free service that lets you remove your numerical ip and port and change it to yourname.mcplay.pw. It is free and will always stay free, no strings attached!">
    <meta name="author" content="Zander van der Meer">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    <link rel="stylesheet" href="stylesheets/base.css">
    <link rel="stylesheet" href="stylesheets/skeleton.css">
    <link rel="stylesheet" href="stylesheets/layout.css">

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>
<div class="container">
    <div class="sixteen columns">
        <h1 style="margin-top: 40px"><?php echo "<a href=\"index.php\"> " . $dns->site_name . "</a>"; ?></h1>
        <hr />
    </div>
    <div class="sixteen columns">
        <img src="http://snapr.pw/i/ce2c7a15683e96bd7c103bf78d94b6.png" width="100%">
    </div>
    <div class="sixteen columns">
        <center>
            <p>
                <hr />
            </p>

            @if(Session::get('success'))
                <div class="alert alert-success" style="">
                    {{ Session::get('success') }}
                </div>
            @endif
            @if(Session::get('error'))
                <div class="alert alert-danger" style="">
                    {{ Session::get('error') }}
                </div>
            @endif
            @if ($errors->has())
                <div class="alert alert-danger" style="">
                    @foreach ($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif

            @yield('content')

        </center>
    </div>
</body>
</html>