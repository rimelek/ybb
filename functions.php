<?php


namespace Rimelek\YBB;

/**
 * BB Code interpreter for youtube videos
 *
 * @param string $text Text that contains bb codes
 * @param array $defaultOptions Array of options to override the defaults.
 *                              If you leave it empty the defaults are:
 * <ul>
 *     <li><strong>nocookie</strong>: Default: "off". If it is "on" youtube-nocookie.com will be used as domain.</li>
 *     <li><strong>controls</strong>: Default: "on". Whether you want to show control buttons or not.</li>
 *     <li><strong>suggestions</strong>: Default: "on". You can turn suggestions after the video on or off.</li>
 *     <li><strong>showinfo</strong>: Default: "on". In case of "off" the title of the video and other information will be hidden.</li>
 *     <li><strong>width</strong>: Default: 560. Width in pixels</li>
 *     <li><strong>height</strong>: Default: 315. Height in pixels</li>
 * </ul>
 * @param array $allowOverride The list of options' names you wish to let to override passing arguments to the BB code.
 * @return string Interpreted text
 */
function ybb($text, array $defaultOptions = [], array $allowOverride = [])
{
    $defaultOptions += [
        'nocookie' => 'off',
        'controls' => 'on',
        'suggestions' => 'on',
        'showinfo' => 'on',
        'width' => '560',
        'height' => '315',
    ];

    $bools = [
        'on' => true,
        'yes' => true,
        'true' => true,
        '1' => true,
        'off' => false,
        'no' => false,
        'false' => false,
        '0' => false,
    ];

    return preg_replace_callback('~\[youtube(?P<args>[^\]]*)](?:(?:(?:(?P<scheme>https?):)?//(?:(?:www\.)?youtube\.[a-z]{2,}/watch\?([^&]*&)?v=|youtu\.be/))?(?P<id>[^&]*?))\[/youtube]~', function($matches) use ($defaultOptions, $allowOverride, $bools) {
        $matches += [
            'schema' => '',
            'id' => '',
            'args' => '',
        ];
        $scheme = $matches['scheme'] ? : 'https';
        $id = $matches['id'] ? : '';
        $argsMatches = [];
        $args = [];
        if (preg_match_all('~(?:([^=\s]+)(?:=(\S+))?)~', $matches['args'], $argsMatches)) {
            foreach ($argsMatches[1] as $i => $name) {
                $name = trim($name);
                if (!$allowOverride or in_array($name, $allowOverride, true)) {
                    $args[$name] = $argsMatches[2][$i] === '' ? 'on' : $argsMatches[2][$i];
                }
            }
        }

        $args += $defaultOptions;
        foreach ($args as $name => $v) {
            if (array_key_exists((string) $v, $bools)) {
                $v = $bools[$v];
            }
            $args[$name] = $v;
        }
        return vsprintf('<iframe width="%d" height="%d" src="'
            . $scheme
            . '://www.youtube%s.com/embed/'
            . $id
            . '?rel=%d&amp;controls=%d&showinfo=%d" frameborder="0" allowfullscreen></iframe>', [
            $args['width'],
            $args['height'],
            $args['nocookie'] ? '-nocookie' : '',
            $args['suggestions'],
            $args['controls'],
            $args['showinfo'],
        ]);
    }, $text);
}