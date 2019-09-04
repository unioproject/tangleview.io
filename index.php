<?php
  $devState = "";
  $url = $_SERVER['REQUEST_URI'];
  $isHome = $url === '/' ? 1 : 0;
  $isInfo = preg_match('/info/', $url);
  $isDashboard = preg_match('/dashboard/', $url);
  $isMonitor = preg_match('/monitor/', $url);
  $isGraph = preg_match('/graph/', $url);
  $isMetrics = preg_match('/metrics/', $url);
  $isAbout = preg_match('/about/', $url);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="">

    <title>tangleview.io - IOTA Tangle Analytics</title>

    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png?v=bOMMdNnJ0c">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png?v=bOMMdNnJ0c">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png?v=bOMMdNnJ0c">
    <link rel="manifest" href="img/favicon/site.webmanifest?v=bOMMdNnJ0c">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg?v=bOMMdNnJ0c" color="#999999">
    <link rel="shortcut icon" href="img/favicon/favicon.ico?v=bOMMdNnJ0c">
    <meta name="msapplication-TileColor" content="#f1f1f1">
    <meta name="msapplication-config" content="img/favicon/browserconfig.xml?v=bOMMdNnJ0c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!-- Matomo -->
    <script>
    var _paq = _paq || [];
    /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    (function() {
        var u = "//tanglenodes.io/analytics/";
        _paq.push(['setTrackerUrl', u + 'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d = document,
            g = d.createElement('script'),
            s = d.getElementsByTagName('script')[0];
        g.type = 'text/javascript';
        g.async = true;
        g.defer = true;
        g.src = u + 'piwik.js';
        s.parentNode.insertBefore(g, s);
    })();
    </script>
    <!-- End Matomo Code -->

</head>

<body class="flex-column">


    <!--<?php echo $url ; ?>-->
    <?php include('sites/header.php'); ?>

    <?php if ($_SERVER['REQUEST_URI'] == "$devState/info" || $_SERVER['REQUEST_URI'] == "$devState/info/"): ?>

    <?php include('sites/info.php'); ?>

    <?php elseif ($_SERVER['REQUEST_URI'] == "$devState/dashboard" || $_SERVER['REQUEST_URI'] == "$devState/dashboard/"): ?>

    <?php include('sites/dashboard.php'); ?>

    <?php elseif ($_SERVER['REQUEST_URI'] == "$devState/graph" || $_SERVER['REQUEST_URI'] == "$devState/graph/"): ?>

    <?php include('sites/graph.php'); ?>

    <?php elseif ($_SERVER['REQUEST_URI'] == "$devState/monitor" || $_SERVER['REQUEST_URI'] == "$devState/monitor/"): ?>

    <?php include('sites/monitor.php'); ?>

    <?php elseif ($_SERVER['REQUEST_URI'] == "$devState/metrics" || $_SERVER['REQUEST_URI'] == "$devState/metrics/"): ?>

    <?php include('sites/metrics.php'); ?>

    <?php elseif ($isAbout): ?>

    <?php include('sites/about.php'); ?>

    <?php else: ?>

    <?php include('sites/info.php'); ?>

    <?php endif; ?>

    <?php if (!$isDashboard): ?>
    <?php include('sites/footer.php'); ?>
    <?php endif; ?>

    <?php if ($isMonitor): ?>
    <script src="js/lokijs.min.js"></script>
    <script src="js/socket.io.min.js"></script>
    <script src="js/tangleview.js"></script>
    <script src="js/lodash.min.js"></script>
    <script src="js/tanglemonitor.js"></script>
    <link rel="stylesheet" type="text/css" href="css/tanglemonitor.css">

    <?php elseif ($isDashboard): ?>

    <link rel="stylesheet" href="css/dashboard.css" />
    <link rel="stylesheet" href="css/graph.css" />
    <link rel="stylesheet" href="css/metrics.css" />
    <link rel="stylesheet" type="text/css" href="css/tanglemonitor.css">

    <script src="js/lokijs.min.js"></script>
    <script src="js/socket.io.min.js"></script>
    <script src="js/tangleview.js"></script>

    <script src="js/lodash.min.js"></script>
    <script src="js/tanglemonitor.js"></script>

    <script src="js/vivagraph.min.js"></script>
    <script src="js/tanglegraph.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="js/tanglegraph-clientadapter.js"></script>

    <script src="js/moment.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/metrics.js"></script>

    <?php elseif ($isGraph): ?>

    <link rel="stylesheet" href="css/graph.css" />

    <script src="js/lokijs.min.js"></script>
    <script src="js/socket.io.min.js"></script>
    <script src="js/tangleview.js"></script>

    <script src="js/vivagraph.min.js"></script>
    <script src="js/tanglegraph.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="js/tanglegraph-clientadapter.js"></script>

    <?php elseif ($isMetrics): ?>

    <link rel="stylesheet" href="css/metrics.css" />
    <script src="js/moment.min.js"></script>
    <script src="js/lodash.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <script src="js/metrics.js"></script>

    <?php endif; ?>

</body>

</html>