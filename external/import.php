<?php
if (!defined('XHGUI_ROOT_DIR')) {
    require dirname(__DIR__) . '/src/bootstrap.php';
}

$options = getopt('f:');

if (!isset($options['f'])) {
    throw new InvalidArgumentException('You should define a file to be loaded');
} else {
    $file = $options['f'];
}

if (!is_readable($file)) {
    throw new InvalidArgumentException($file.' isn\'t readable');
}

$container = Xhgui_ServiceContainer::instance();
$saver = $container['saver.mongo'];

$data = json_decode(file_get_contents($file), true);
if ($data) {
    $saver->save(['profile' => $data]);
}
