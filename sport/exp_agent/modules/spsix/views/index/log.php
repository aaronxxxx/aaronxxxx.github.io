<div>
    <?php if($list){
        foreach ($list as $key=>$val){?>
            <p><?=$val['log_info']?></p>
    <?php }
    }else{?>
    <p>该记录未被修改过</p>
   <?php }?>
</div>