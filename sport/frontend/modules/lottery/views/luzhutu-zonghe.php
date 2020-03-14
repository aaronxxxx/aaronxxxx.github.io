<?php
    $arrType['1']=array('dishReload_small','dishReload_da','dishReload_tie');
    $arrType['0']=array('dishReload_shuang','dishReload_dan','dishReload_tie');
    $arrType['2']=array('dishReload_long','dishReload_tiger','dishReload_tie');
    for($i=0;$i<6;$i++){
?>
    <tr>
<?php
    foreach($arrs[1][$i] as $v){
    if($v) {
?>
    <td title="<?=$v['title']?>" class="<?=$arrType[$type][$v['issingle']]?>"></td>
<?php }else{ ?>
    <td></td>
<?php } } ?>
    </tr>
<?php } ?>
