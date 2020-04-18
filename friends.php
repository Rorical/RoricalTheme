<?php
/**
 * 友情链接
 *
 * @package custom
 */
 ?>
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
            </div>
            
            <div class="mt-5 py-5 border-top">
              <div class="row justify-content-center">
                <div class="col-lg-9 breakword content">
                  <?php $this->content(); ?>
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
    <script>
    
    $("div#list").each(function(){
    	$(this).children("ul").each(function(){
    		title = $(this).children("li.title").text()
    		url = $(this).children("li.url").text()
    		img = $(this).children("li.img").text()
    		dec = $(this).children("li.dec").text()
    		inner = '<div class="col-md-3 mb-5 py-5 mb-md-0 border-0 "><div class="card shadow containter py-2 text-center card-lift--hover"><a href="' + url + '" target="_blank" style="padding-top: 2rem !important"><div class="icon icon-shape rounded-circle text-white mb-3" style="background:url(' + img + ') center center / cover no-repeat;"></div><h6>' + title + '</h6><p class="description">' + dec + '</p></div></div>'
    		$(this).parent().append(inner);
    		$(this).remove()
		})
		$(this).addClass("container-lg py-5 row justify-content-center text-center content")
    })
    </script>
    <?php $this->need('comments.php'); ?>
  </main>

<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
