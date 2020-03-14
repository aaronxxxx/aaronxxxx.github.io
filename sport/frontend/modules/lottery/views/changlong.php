<?php foreach ($changlong as $key => $val){
    if($val > 1){
?>
    <tr><td class="bq-title"><?=$key?></td><td class="col_single"><font color="red"><?=$val?>期</font></td></tr>
<?php }} ?>