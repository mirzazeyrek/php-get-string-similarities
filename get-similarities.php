<?php
function get_decorated_diff($old, $new, $get_similarity=false){
    $from_start = strspn($old ^ $new, "\0");        
    $from_end = strspn(strrev($old) ^ strrev($new), "\0");

    $old_end = strlen($old) - $from_end;
    $new_end = strlen($new) - $from_end;

    $start = substr($new, 0, $from_start);
    $end = substr($new, $new_end);
    $new_diff = substr($new, $from_start, $new_end - $from_start);  
    $old_diff = substr($old, $from_start, $old_end - $from_start);

    $new = "$start<ins style='background-color:#ccffcc'>$new_diff</ins>$end";
    $old = "$start<del style='background-color:#ffcccc'>$old_diff</del>$end";
    if($get_similarity)
    $get_similarity = "<ins style='background-color:#ccffcc'>$start $end</ins>"; 
    return array("old"=>$old, "new"=>$new, "similarity"=>$get_similarity);
}

$string_old = "The quick brown fox jumped over the lazy dog";
$string_new = "The quick white rabbit jumped over the lazy dog";
$diff = get_decorated_diff($string_old, $string_new, true);
echo "<table border=1>
    <tr align=center>
        <td>old</td>
        <td>new</td>
        <td>similarity</td>
    </tr>
    <tr>
        <td>".$diff['old']."</td>
        <td>".$diff['new']."</td>
        <td>".$diff['similarity']."</td>
    </tr>
</table>";
