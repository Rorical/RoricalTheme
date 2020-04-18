<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

	<script>page = 1</script>
<main class="profile-page">
    <section class="section-profile-cover section-shaped" style="margin: 85px 0;">
      <!-- Circles background -->
      <div class="shape shape-style-1 alpha-4 shape-background banner">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </div>
      <!-- SVG separator -->
    </section>
    
    <section class="section">
      <div class="">
        <div class="card card-profile">
          <div class="px-4">
    		<div class="text-center mt-5" style="margin: 50px auto;">
              <h2 class="display-2"><?php $this->title() ?></h2>
              <br>
              <div class="h6 font-weight-300"><i class="ni location_pin mr-2"></i><a href="<?php $this->author->permalink(); ?>" rel="author"><?php $this->author(); ?></a> <time style="margin:auto 10px;" datetime="<?php $this->date('c'); ?>"><?php $this->date(); ?></time></div></div>
            <div class="row justify-content-center">
              <div class="col-lg-6">
                <div class="card-profile-stats d-flex justify-content-center">
                  <div>
                    <span class="heading"><?php echo ViewsCounter_Plugin::getViews(); ?></span>
                    <span class="description">观看次数</span>
                  </div>
                  <div>
                    <span class="heading"><?php art_count($this->cid); ?></span>
                    <span class="description">字数</span>
                  </div>
                  <div>
                    <span class="heading"><?php $this->commentsNum('%d'); ?></span>
                    <span class="description">评论</span>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 text-lg-right align-self-lg-center">
                <div class="card-profile-actions card-profile-stats d-flex justify-content-center">
                	<? if (count($this->tags)>0): ?>
        			<?php foreach( $this->tags as $tags): ?>
        			<a href="<? print($tags['permalink']) ?>" class="btn btn-sm btn-info mr-4"><? print($tags['name']) ?></a>
        			<?php endforeach; ?>
        			<?php else: ?>
        			<a class="btn btn-sm btn-info mr-4">无标签..</a>
        			<?php endif; ?>
        			<?php foreach( $this->categories as $categories): ?>
        			<a href="<? echo $categories['permalink']; ?>" class="btn btn-sm btn-default float-right"><? echo $categories['name']; ?></a	>
        			<?php endforeach;?>
                </div>
              </div>
            </div>
            
            <div class="mt-5 py-5 border-top">
              <div class="row justify-content-center">
                <div class="col-lg-9 breakword content">
                  <?php 
                	$content = preg_replace('/<img(.*?)src=[\'"]([^\'"]+)[\'"](.*?)>/i',"<noscript>\$0</noscript><img\$1data-original=\"\$2\" \$3>",$this->content); 
                	echo $content 
                	?>
                  
                </div>
              </div>
            </div>
            <div class="border-top text-center">
            	<br>
            </div>
            
          </div>
        </div>
      </div>
    </section>
    <?php if(!$this->hidden && $this->allow('comment')) $this->need('comments.php'); ?>
  </main>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
