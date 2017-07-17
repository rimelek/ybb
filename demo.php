<?php

use Rimelek\YBB;

require 'vendor/autoload.php';

$yid = filter_input(INPUT_GET, 'yid');

$texts = [
    '[youtube showinfo=off]https://www.youtube.com/watch?v=%s[/youtube]',
    '[youtube showinfo=off]https://www.youtube.com/watch?v=%s&some=thing[/youtube]',
    '[youtube showinfo=off]https://www.youtube.com/watch?some=thing&v=%s[/youtube]',
    '[youtube]https://youtube.com/watch?v=%s[/youtube]',
    '[youtube]http://www.youtube.com/watch?v=%s[/youtube]',
    '[youtube]//www.youtube.com/watch?v=%s[/youtube]',
    '[youtube]https://youtu.be/%s[/youtube]',
    '[youtube]http://youtu.be/%s[/youtube]',
    '[youtube]//youtu.be/%s[/youtube]',
    '[youtube suggestions=off]%s[/youtube]',
    '[youtube width=350 height=300 nocookie controls=off]%s[/youtube]',
];

if (!$yid) {
    echo 'Set a youtube video id in the URL. Example: '
        . (filter_input(INPUT_SERVER, 'HTTPS') ? 'https' : 'http')
        . '://'
        . filter_input(INPUT_SERVER, 'HTTP_HOST')
        . filter_input(INPUT_SERVER, 'PHP_SELF')
        . '?yid=COPYTHEIDHERE';
    exit;
}


foreach ($texts as $k => $text) {
    echo YBB\ybb(sprintf($text, $yid), ['nocookie' => true]) . '<br />';
}
