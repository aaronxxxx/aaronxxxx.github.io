<script type="text/javascript" language="javascript" src="/public/common/js/ckeditor/ckeditor.js"></script>

<div class="tabft13 trinput  zudan spanmg0">
<p>
    <span>类别：</span>
    <span><strong>
    <?php 
    if ($banner_type == '手機輪播圖'){
        echo '手機輪播圖';
     }elseif($banner_type == '優惠活動'){
        echo '優惠活動';
    }
    ?>
    </strong></span>
    
    <input name="editid" type="hidden" id="editid" size="20" maxlength="16"/>
</p>
<p>
    <span>排序：</span>
    <span><input name="sort" type="text" id="sort" value="" size="20" maxlength="16"/></span>
</p>
<p>
    <span>標題：</span>
    <span><input name="title" type="text" id="title" value="" size="20" maxlength="100"/></span>
</p>
</div>
<?php if($banner_type == '優惠活動'){?>
<div class="tabft13 trinput  zudan spanmg0">
<p>
    <span>副標：</span>
    <span><input name="sub_title" type="text" id="sub_title" value="" size="20" maxlength="100"/></span>
</p>
</div>
<p>
    <span>內容：</span>
   
    <textarea name="content" id="content" rows="5" cols="80"></textarea>
    
</p>
<?php }?>
<div class="tabft13 trinput  zudan spanmg0">
<p>
    <span>圖片位置：</span>
    <span><input name="img_url" type="text" id="img_url" value="" size="100" maxlength="100"/> 
    <?php if($banner_type == '手機輪播圖'){?>
        手机轮播图片规格宽922px * 高360px。
    <?php }elseif($banner_type == '優惠活動'){?>
        活动图片规格宽603px * 高170px。
        <?php }?>
    </span>
</p>
<p>
    <span id="new"><input type="button" value="确认发布" onclick="ajaxBanner()"></span>
    <span id="modify" style="display:none"><input type="button" onclick="edit_Banner()"  name="modify" value="确认修改">&emsp;<input type="button" value="取消" onclick="cancel_edit()"></span>

</p>
<p><?php 
    if ($banner_type == '手機輪播圖'){
        echo '<input name="type" type="hidden" id="type" size="20" value="1" maxlength="16"/>';
     }elseif($banner_type == '優惠活動'){
        echo '<input name="type" type="hidden" id="type" size="20" value="2" maxlength="16"/>';
    }
    ?></p>
</div>   
            
       
<table id = "testing" width="100%" border="0" cellpadding="5" cellspacing="1" class="font13 skintable line35">
    <tr class="namecolor">
        <td width="10%"><strong>类别</strong></td>
        <td width="10%" ><strong>排序</strong></td>
        <td width="10%" ><strong>標題</strong></td>
        <?php if($banner_type == '優惠活動'){?>
        <td width="10%" ><strong>副標</strong></td>
        <td style="display:none" width="20%" ><strong>內容</strong></td>
        <?php }?>        
        <td width="30%" ><strong>目前圖片</strong></td>       
        <td width="10%" ><strong>操作</strong></td>
    </tr>
<?php 

 if(isset($banner) && count($banner) > 0){
    
    foreach($banner as $key =>$val){
        
        ?>        
    <tr class="namecolor">        
        <td align="center" valign="middle">   
         <?php 
            if ($val['type'] == '1'){
                echo '手機輪播圖';
            }elseif($val['type'] == '2'){
                 echo '優惠活動';}
        ?>
    </td>
        <td  valign="middle"><?= $val['sort']?></td>
        <td  valign="middle"><?= $val['title']?></td>
        <?php if($val['type'] == '2'){?>
        <td  valign="middle"><?= $val['sub_title']?></td>       
        <td style="display:none" id = "<?= $val['id']?><?=$val['sort']?>" valign="middle"><?= $val['content']?></td>  
        <?php }?>  
        <td  valign="middle"><img height="50%" src = '<?= $val['img_url']?>'></td>       
        <td  class="trinput">
        <input type="button" value="编辑" onclick="showBanner('<?=$val['id']?>','<?=$val['sort']?>','<?=$val['title']?>','<?=$val['sub_title']?>','<?=$val['img_url']?>','<?=$val['type']?>');">&nbsp;
        <input type="button" value="删除" onclick="deleteBanner('<?=$val['id']?>');">
        </td>
    </tr>
<?php 
       } 
    }
?>
</table>
<?php if($banner_type == '優惠活動'){?>
<script>
//CKEDITOR.replace( 'content', {});
var editor = CKEDITOR.replace("content");
//editor.setData("輸入文字");
</script>
 <?php }?>

<script>
function ajaxBanner(){              //確認新增
    var title = $("#title").val();
    <?php if($banner_type == '優惠活動'){?> 
    var content= CKEDITOR.instances.content.getData();     
   
    <?php }elseif($banner_type == '手機輪播圖'){?>
         var content = $("#content").val();
        <?php }?>
    var img_url = $("#img_url").val();
    var sub_title = $("#sub_title").val();
    var sort = $("#sort").val();
    var type = $('#type').val();	
	$.ajax({
		url:'/?r=sysmng/banner/newinformation',
        type:'post',
		data: {title:title,content:content,img_url:img_url,sub_title:sub_title,sort:sort,type:type},
		success:function (data) {
            data = JSON.parse(data);
            if(data.status)
            {
                layer.alert(data.msg, function (index) {
                    layer.closeAll();
                    window.location.reload();
                });
            }
            else{
                layer.alert(data.msg);
            }
        }		
	});
	
}

function showBanner(id,sort,title,sub_title,img_url,type){      //編輯功能
    var aid = "#" + id + sort;
    var r = $(aid).html();
        $('#new').hide();
        $('#modify').show();
        $('input[name="sort"]').val(sort);
        $('input[name="title"]').val(title);
        $('input[name="sub_title"]').val(sub_title);
        //$('input[name="content"]').val(content);              
        $('input[name="img_url"]').val(img_url);
        $('input[name="type"]').val(type);
        $('input[name="editid"]').val(id);
        CKEDITOR.instances.content.setData(r); 
    }




    
function cancel_edit(){     //取消修改
        $('#new').show();
        $('#modify').hide();
        $('input[name="sort"]').val('');
        $('input[name="title"]').val('');
        $('input[name="sub_title"]').val('');
        $('input[name="content"]').val('');       
        $('input[name="img_url"]').val('');
        $('input[name="editid"]').val('');
        CKEDITOR.instances.content.setData(''); 
    }
function edit_Banner(){         //確認修改
	    var type = $("#type").val();
	    var title = $("#title").val();
        var sort = $("#sort").val();

        <?php if($banner_type == '優惠活動'){?> 
            var content= CKEDITOR.instances.content.getData(); 
    <?php }elseif($banner_type == '手機輪播圖'){?>
         var content = $("#content").val();
        <?php }?>


        var img_url = $("#img_url").val();
        var sub_title = $("#sub_title").val();
        var editid = $('#editid').val();
        $.ajax({
        url:'?r=sysmng/banner/update-banner',
        type:'post',        
        data: {id:editid,title:title,content:content,img_url:img_url,sub_title:sub_title,sort:sort,type:type},        
        success:function (data) {
            data = JSON.parse(data);
            if(data.status)
            {
                layer.alert(data.msg, function (index) {
                    layer.closeAll();
                    window.location.reload();
                });
            }
            else{
                layer.alert(data.msg);
            }
        }
        });
    } 

    function deleteBanner(id){      //刪除功能
        $.ajax({
        url:'?r=sysmng/banner/delete-banner',
        data: {id: id},
        success:function (data) {
            data = JSON.parse(data);
            if(data.status)
            {
                layer.alert(data.msg, function (index) {
                    layer.closeAll();
                    window.location.reload();
                });
            }
            else{
                layer.alert(data.msg);
            }
        }
        });
    }    
        
</script>
