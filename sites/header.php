<div id="main-header" class="bg-header">
    <header class="main-header flex-column">

        <h1 id="site-name" class="text-center">
            <a href="<?php echo $devState;?>/">
                <img src="img/logo_header.png" alt="" class="nav-logo">
                tangleview.io <sup class="tiny-text">BETA</sup>
            </a>
        </h1>
        <ul class="main-nav">
            <li><a href="<?php echo $devState;?>/dashboard">Dashboard</a></li>
            <li><a href="<?php echo $devState;?>/graph">Graph</a></li>
            <li><a href="<?php echo $devState;?>/monitor">Monitor</a></li>
            <li><a href="<?php echo $devState;?>/metrics">Metrics</a></li>
        </ul>
    </header>
</div>

<div id="status_msg_wrapper" class="text-center bold hide">
    <span id="status_msg"></span>
    <span id="status_close" class="margin-left5">
        <img src="img/close.png" />
    </span>
</div>