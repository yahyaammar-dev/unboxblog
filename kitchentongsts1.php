<?php
$page = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
$referer = $_SERVER['HTTP_REFERER'];
$baseFile = str_replace('/', '', $_SERVER['PHP_SELF']);
$domainUrl = str_replace($baseFile, '', $_SERVER['SCRIPT_URI']); // https://amazonproexperts.com/tproxy.php
if (empty($_GET['status'])) {
    $sec = 1;
    header("Refresh: $sec; url=$page&status=1");
    exit;
}
$_SERVER['HTTP_REFERER'] = $domainUrl;
if (!empty($_GET['url']) && !empty($_GET['type']) && $_GET['type'] == 'domain') {
    $milliseconds = round(microtime(true) * 1000);
    $url = urldecode($_GET['url']);
    if (strpos($url, 'qid') !== false) {
        $url = preg_replace("#&qid=.*&#", '&qid=' . $milliseconds . '&', $url);
    }
    if (filter_var($_GET['url'], FILTER_VALIDATE_URL)) {
        header('Location: ' . $url);
        exit();
    } else {
        die('URL is not valid');
    }
} else {
    die('No URL GIVEN');
}