<?php
/**
 * 炒鸡可爱的一款主题
 * 
 * @package Rorical Theme 
 * @author Rorical
 * @version 1.0
 * @link https://blog.boxpaper.club/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

	<script>page = 0</script>
<section class="section-hero section-shaped my-0"> 
     <div class="shape shape-style-1 shape-background banner"> 
      <span class="span-150" ></span> 
      <span class="span-50" ></span> 
      <span class="span-50" ></span> 
      <span class="span-75" ></span> 
      <span class="span-100" ></span> 
      <span class="span-75" ></span> 
      <span class="span-50"></span> 
      <span class="span-100" ></span> 
      <span class="span-50" ></span> 
      <span class="span-100" ></span> 
     </div>
     <div class="container shape-container d-flex align-items-center"> 
      <div class="col px-0"> 
       <div class="row justify-content-center align-items-center"> 
        <div class="col-lg-7 text-center pt-lg"> 
         <img src="<?php $this->options->AvatarUrl() ?>" style="width: 200px;" class="img-fluid pic rounded-circle shadow">
         <div class="splight_div">
         <h1 class="display-1 text-white splight" data-spotlight="<?php $this->options->title() ?>"><?php $this->options->title() ?></h1>
         </div>
         <p class="lead text-white mt-4 mb-5"><?php $this->options->description() ?></p> 
         <div class="btn-wrapper"> 
         </div> 
        </div> 
       </div> 
       <div class="row align-items-center justify-content-around stars-and-coded"> 
        <div class="col-sm-4"></div> 
        <div class="col-sm-4 mt-4 mt-sm-0 text-right"></div> 
       </div> 
      </div> 
     </div> 
    </section>
<?php $this->need('sidebar.php');?>
    <section class="section section-components bg-secondary">
    	<div class="container container-lg py-5 align-items-center" style="text-align: center;">
    		<?php while($this->next()): ?>
      		<div class="row-grid justify-content-between mt-lg card card-lift--hover shadow border-0" style="margin:auto;">
        	<a href="<?php $this->permalink() ?>" title="<?php $this->title() ?>">
        		<img data-original="<? echo( $this->fields->pic ? $this->fields->pic:$this->options->randompicUrl() . "?_=" . mt_rand() ) ?>" no-viewer class="card-img">
        		<div class="card shadow">
        			<div class="card-body">
        				<div class="tab-content">
        					<div role="tabpanel" aria-labelledby="tabs-icons-text-1-tab" class="tab-pane fade show active">
        						<div class="row align-items-center">
        <div class="col-sm-4">
          <h3 class="display-4 mb-0"><?php $this->title() ?></h3>
        </div>
        <div class="col-sm-8">
        	<br>
        <object style="color: #888;">
        <span class="col-xs-11"><i class="fa fa-calendar"></i> <time datetime="<?php $this->date('c'); ?>"><?php $this->date();?></time></span>
        <span style="margin:auto 10px;"><i class="fa fa-comments"></i> <?php $this->commentsNum('%d');?></span>
        <span><i class="fa fa-envelope-open-o"></i> 
        <?php foreach( $this->categories as $categories): ?>
        <a href="<? echo $categories['permalink']; ?>" class="badge badge-info"><? echo $categories['name']; ?></a>
        <?php endforeach;?>
        </span>
        <span>
        <? if (count($this->tags)>0): ?>
        <i class="fa fa-tags"></i> 
        <?php foreach( $this->tags as $tags): ?>
        <a href="<? print($tags['permalink']) ?>" class="badge badge-success"><? print($tags['name']) ?></a>
        <?php endforeach;?>
		<?php else: ?>
		<i class="fa fa-tags"></i> <a class="badge badge-default text-white">无标签..</a>
        <?php endif;?>
        </span>
        <span class="col-xs-11"><i class="fa fa-user-circle-o"></i><a class="badge badge-warning" href="<?php $this->author->permalink(); ?>"><?php $this->author();?></a></span>
        </object>
        <p class="text-black"> <?php $this->excerpt(30,'') ?> </p>
        </div>
      </div>
        					</div>
        				</div>
        			</div>
        		</div>
        		</a>
      </div>
      <?php endwhile;?>
      </div>
      <nav class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 text-center">
        <?php $this->pageNav('<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination agination-lg justify-content-center', 'itemTag' => 'li', 'textTag' => 'a', 'currentClass' =>  'page-item active','prevClass' => 'page-item','nextClass' => 'page-item','linkClass' => 'page-link','itemClass' => 'page-item'));?>
		</div>
		</div>
		</nav>
      <? if($this->_currentPage>1) echo("<script>$('html,body').animate({ scrollTop: $('.section.section-components.bg-secondary').offset().top }, 500)</script>") ?>
    </section>

<?php $this->need('footer.php');?>