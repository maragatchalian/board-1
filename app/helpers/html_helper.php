<?php
function to_html_entities($string)
{
    if (!isset($string)) return;
    echo htmlspecialchars($string, ENT_QUOTES);
}

function readable_text($s)                    
{
    $s = htmlspecialchars($s, ENT_QUOTES);
    $s = nl2br($s);
    return $s;                    
} //Returns line breaks

function redirect($url)
{
    header("Location: " . $url);
    exit();
}


