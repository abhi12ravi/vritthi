<?php
$url = 'http://www.spoj.com/users/abhi12ravi/';
$output = file_get_contents($url); 

echo "The type of output is: ";
print_r(gettype($output));
echo "<br>";

function crawl_page($url, $depth = 5)
{
    static $seen = array();
    if (isset($seen[$url]) || $depth === 0) {
        return;
    }

    $seen[$url] = true;

    $dom = new DOMDocument('1.0');
    @$dom->loadHTMLFile($url);

    $anchors = $dom->getElementsByTagName('a');
    foreach ($anchors as $element) {
         $href = $element->getAttribute('href');
         echo "The type of output is: ";
         print_r(gettype($href));
         echo "<br>";
         print_r($href);

    //     if (0 !== strpos($href, 'http')) {
    //         $path = '/' . ltrim($href, '/');
    //         if (extension_loaded('http')) {
    //             $href = http_build_url($url, array('path' => $path));
    //         } else {
    //             $parts = parse_url($url);
    //             $href = $parts['scheme'] . '://';
    //             if (isset($parts['user']) && isset($parts['pass'])) {
    //                 $href .= $parts['user'] . ':' . $parts['pass'] . '@';
    //             }
    //             $href .= $parts['host'];
    //             if (isset($parts['port'])) {
    //                 $href .= ':' . $parts['port'];
    //             }
    //             $href .= $path;
    //         }
    //     }
    //     crawl_page($href, $depth - 1);
    // }

    var_dump($anchors);

    //echo "URL:",$url,PHP_EOL,"CONTENT:",PHP_EOL,$dom->saveHTML(),PHP_EOL,PHP_EOL;
}
crawl_page("http://hobodave.com", 2);

?>