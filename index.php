<?php

// Fallback untuk hosting yang tidak support .htaccess rewrite (InfinityFree)
// Mengarahkan request ke public/index.php

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Jika file statis ada di public/, serve langsung
$publicPath = __DIR__ . '/public' . $uri;
if ($uri !== '/' && file_exists($publicPath) && !is_dir($publicPath)) {
    return false;
}

// Forward ke Laravel
require __DIR__ . '/public/index.php';
