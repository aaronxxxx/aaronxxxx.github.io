<!-- layout main -->
<link href="/public/aomen/css/activity.css" rel="stylesheet" />
<link href="/public/layer/skin/layer.css" rel="stylesheet" />
<main>
    <div class="activityBg">
        <?php foreach ($offer_activity as $key => $value) { ?>
            <div class="activity">
                <div class="innerTop" style="background-image:url(<?php echo $value['img_url'];?>);">
                    <div><?php echo $value['title'];?></div>
                </div>
                <div class="innerBottom">
                    <div class="title"><?php echo $value['sub_title'];?></div>
                    <div class="allow"></div>
                </div>
                <div class="intro">
                    <?php echo $value['content'];?>
                </div>
            </div>
        <?php } ?>
    </div>
</main>
<script>
    $(function() {
        $('.intro').hide();
        $('.activity').click(function() {
            var thisAllow = $(this).find('.allow');
            var thisIntro = $(this).find('.intro');
            var intro = $(this).find('.intro').css('display');
            $('.intro').not(this).slideUp();
            $('.allow').not(this).removeClass('rotate');
            if (intro == 'flex') {
                thisAllow.removeClass('rotate');
                thisIntro.slideUp();
            } else {
                thisAllow.addClass('rotate');
                thisIntro.slideDown();
            }
        });
        var total_height = $(window).height(),
            header = $('header').height() + 30, //30 是padding高度
            footer = $('footer').height();
            $('main').css({'padding-top': header,'padding-bottom': footer,'min-height':total_height-header,});
    });
</script>