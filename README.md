# README

## Description

This is just a simple function convert youtube video links or video IDs to the video embed code using BB codes.
You can pass arguments to the BB code or you can disable them.
 
# Arguments

- **nocookie**: Default: "off". If it is "on" youtube-nocookie.com will be used as domain.
- **controls**: Default: "on". Whether you want to show control buttons or not.
- **suggestions**: Default: "on". You can turn suggestions after the video on or off.
- **showinfo**: Default: "on". In case of "off" the title of the video and other information will be hidden.
- **width**: Default: 560. Width in pixels
- **height**: Default: 315. Height in pixels
</ul>
 
## Examples

### BB codes

    [youtube showinfo=off]https://www.youtube.com/watch?v=tH2TvzgFCU0[/youtube]
    [youtube]https://youtube.com/watch?v=tH2TvzgFCU0[/youtube]
    [youtube]http://www.youtube.com/watch?v=tH2TvzgFCU0[/youtube]
    [youtube]//www.youtube.com/watch?v=tH2TvzgFCU0[/youtube]
    [youtube]https://youtu.be/tH2TvzgFCU0[/youtube]
    [youtube]http://youtu.be/tH2TvzgFCU0[/youtube]
    [youtube]//youtu.be/tH2TvzgFCU0[/youtube]
    [youtube suggestions=off]tH2TvzgFCU0[/youtube]
    [youtube width=350 height=300 nocookie controls=off]tH2TvzgFCU0[/youtube]
    
### Usage of the function

    <?php
    use Rimelek\YBB;
    
    $text = '... Here is your text containing bb codes like:     [youtube width=350 height=300 nocookie controls=off]tH2TvzgFCU0[/youtube] ... ';
    
    echo YBB\ybb($text);
    echo YBB\ybb($text, ['nocookie' => 'on']);
    echo YBB\ybb($text, ['nocookie' => 'on'], ['width', 'height']);
    
Instead of "on", you can always write "yes", "1", or "true"
Instead of "off", you can always write "no", "0" or "false"
    
Run [demo.php](demo.php) for a working demo.