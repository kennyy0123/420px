<?php
    require_once('class/rssfeed.class.php');
  
    if (isset($_GET['usr'])) {
        header('Content-Type: text/xml+rss');
        $rss_feed = new RSS();
        $result = $rss_feed->create_rssfeed($_GET['usr']);
    }
    else
        header('Location: ../xml.php');
?>