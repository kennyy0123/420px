<?php
    require_once('user/rssfeed.class.php');
    header('Content-Type: text/xml+rss');
    $rss_feed = new RSS();
    $rss_feed->create_rssfeed($_GET['usr']);
?>