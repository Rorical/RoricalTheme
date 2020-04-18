<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

	<script>page = 1</script>
    <section class="section section-components bg-secondary">
    	<div class="container container-lg py-5 align-items-center" style="text-align: center;">
    		<br>
    		<br>
    		<h2 class="display-2" style="width:85%;margin:auto"><a class="nav-link mb-sm-3 mb-md-0 active" style="width:85%;margin:auto"id="tabs-icons-text-1-tab"><div class="card-profile-image">
                </div><span class="text-info card card-profile shadow" style="width:85%;margin:auto">
    		<?php $this->archiveTitle(array(
            'category'  =>  _t('%s'),
            'search'    =>  _t('( %s )'),
            'tag'       =>  _t('< %s >'),
            'author'    =>  _t('%s 发布的文章 <br>' )
        ), '', ''); ?>
        </span></a></h2>
    		<?php if ($this->have()): ?>
    		<?php while($this->next()): ?>
      		<div class="row-grid justify-content-between mt-lg card card-lift--hover shadow border-0" style="margin:auto;">
        	<a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">
        		<img data-original="<? echo( $this->fields->pic ? $this->fields->pic:$this->options->randompicUrl() . "?_=" . mt_rand() ) ?>" no-viewer class="card-img">
        	</a>
        		<div class="card shadow">
        			<div class="card-body">
        				<div class="tab-content">
        					<div role="tabpanel" aria-labelledby="tabs-icons-text-1-tab" class="tab-pane fade show active">
        						<div class="row align-items-center">
        <div class="col-sm-4">
        	<a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">
        		
          <h3 class="display-4 mb-0"><?php $this->title() ?></h3>
          </a>
        </div>
        
        <div class="col-sm-8">
        	<br>
        <div style="color: #888;">
        <span class="col-xs-11"><i class="fa fa-calendar"></i> <time datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time></span>
        <span style="margin:auto 10px;"><i class="fa fa-comments"></i> <?php $this->commentsNum('%d'); ?></span>
        <span><i class="fa fa-envelope-open-o"></i> 
        <?php foreach( $this->categories as $categories): ?>
        <a href="<? echo $categories['permalink']; ?>" class="badge badge-info"><? echo $categories['name']; ?></a>
        <?php endforeach;?>
        </span>
        <span><i class="fa fa-tags"></i> 
        <? if (count($this->tags)>0): ?>
        <?php foreach( $this->tags as $tags): ?>
        <a href="<? print($tags['permalink']) ?>" class="badge badge-success"><? print($tags['name']) ?></a>
        <?php endforeach; ?>
        <?php else: ?>
        <a class="badge badge-default text-white">无标签..</a>
        <?php endif; ?>
        </span>
        <span class="col-xs-11"><i class="fa fa-user-circle-o"></i><a class="badge badge-warning" href="<?php $this->author->permalink(); ?>"><?php $this->author(); ?></a></span>
        </div>
        <p class="text-black"> <?php $this->excerpt(30,'') ?> </p>
        
        </div>
      </div>
        					</div>
        				</div>
        			</div>
        		</div>
      </div>
      <?php endwhile; ?>
      <?php endif; ?>
      </div>
      <nav class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
        <?php $this->pageNav('<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination agination-lg justify-content-center', 'itemTag' => 'li', 'textTag' => 'a', 'currentClass' =>  'page-item active','prevClass' => 'page-item','nextClass' => 'page-item','linkClass' => 'page-link','itemClass' => 'page-item')); ?>
		</div>
		</div>
		</nav>


    </section>
    
    
    

	<?php $this->need('sidebar.php'); ?>

	<?php $this->need('footer.php'); ?>
