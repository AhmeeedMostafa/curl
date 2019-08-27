<?php if(!class_exists('raintpl')){exit;}?><?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes/header") . ( substr("includes/header",-1,1) != "/" ? "/" : "" ) . basename("includes/header") );?>


<div id="header">
    <h1><img src="templates/air/images/header/message-icon.png" alt="message">تواصل معنا</h1>
    <div id="header-right"></div>
    <div id="header-left"></div>
</div>

<div id="content">
    <div id="response" class="success">
        <?php if( $ltr ){ ?>

        <img src="templates/air/images/response/success-icon-ltr.png" alt="<?php echo $status;?>" class="fail-icon">
        <?php }else{ ?>

        <img src="templates/air/images/response/success-icon.png" alt="<?php echo $status;?>" class="fail-icon">
        <?php } ?>

        <h2><?php echo $headline;?></h2>
        <p><?php echo $message;?></p>
        <a href="<?php echo $button["url"];?>" class="button"><?php echo $button["text"];?></a>
    </div>
</div><!-- #content -->

<?php $tpl = new RainTPL;$tpl_dir_temp = self::$tpl_dir;$tpl->assign( $this->var );$tpl->draw( dirname("includes/footer") . ( substr("includes/footer",-1,1) != "/" ? "/" : "" ) . basename("includes/footer") );?>