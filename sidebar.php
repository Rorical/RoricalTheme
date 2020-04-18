<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="section section-components">
	<div class="container container-lg align-items-center" style="text-align: center;">
		<div class="row">
        	<div class="col-sm-3 col-6">
        		<h3>
        <span><?php _e('归档'); ?></span>
    	</h3>
            <?php $this->widget('Widget_Contents_Post_Date', 'limit=3&type=month&format=F Y')
            ->parse('<a href="{permalink}" class="alert  fade show" role="alert"><div class="alert alert-success ">
        				<span class="alert-inner--text"><strong>{date}</strong></span>
    				</div></a>'); ?>
        
        		</div>
        		<div class="col-sm-3 col-6">
        <h3>
        <span><?php _e('最新文章'); ?></span>
    	</h3>
            <?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=3')
            ->parse('<a href="{permalink}" class="alert  fade show" role="alert"><div class="alert alert-info ">
        				<span class="alert-inner--text"><strong>{title}</strong></span>
    				</div></a>'); ?>
        
          
        </div>
        <div class="col-sm-3 col-6">
        	<h3>
        <span><?php _e('最近回复'); ?></span>
    	</h3>
        <?php $this->widget('Widget_Comments_Recent','ignoreAuthor=true&limit=3')->to($comments); ?>
        <?php while($comments->next()): ?>
        	<a href="<?php $comments->permalink(); ?>" class="alert  fade show" role="alert"><div class="alert alert-warning ">
        				<span class="alert-inner--text"><strong><?php $comments->author(false); ?></strong>: <?php $comments->excerpt(19, '...'); ?></span>
    				</div></a>
        <?php endwhile; ?>

        	</div>
        	<div class="col-sm-3 col-6">
        	<h3>
        <span><?php _e('搜索文章'); ?></span>
    	</h3>
		<div class="form-group">
		<form method="post" id="search" action="<?php $this->options->siteUrl(); ?>" role="search">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                </div>
                <input class="form-control" type="text" id="s" name="s" placeholder="搜索">
              </div>
              <input class="btn btn-1 btn-outline-primary submit" type="submit" value="搜索吧！">
            </form>
            </div>
    	</div>
      </div>
		
    </div>
</section>