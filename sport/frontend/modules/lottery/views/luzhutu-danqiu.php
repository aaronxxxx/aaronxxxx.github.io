<?php
    $arr1=array('dishReload_shuang','dishReload_dan');
    $arr2=array('dishReload_small','dishReload_da');
    for($i=0;$i<6;$i++){
?>
    <tr>
<?php
    if($type==2){
        foreach($ball_nums[1][$i] as $v) {
        if($v){
?>
        <td title="<?=$v['title']?>"><?=$v['ball_num']?></td>
        <?php }else{ ?>
        <td></td>
 <?php }}}else {
        foreach($arrs[1][$i] as $v){
        if($v){
        if($type ==1){
            ?>
            <td title="<?=$v['title']?>" class="<?=$arr2[$v['isbig']]?>"></td>
            <?php }else{ ?>
            <td title="<?=$v['title']?>" class="<?=$arr1[$v['issingle']]?>"></td>';
            <?php }}else{ ?>
            <td></td>
<?php }}} ?>
    </tr>
<?php } ?>