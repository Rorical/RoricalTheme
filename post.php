<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

	<script>page = 0</script>
<main class="profile-page">
    <section class="section-profile-cover section-shaped my-0">
      <!-- Circles background -->
      <div class="shape shape-style-1 alpha-4 shape-background">
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
    <div class="card shadow border-0 bg-secondary toc-container">
    	<a class="carousel-control-prev" id="toc-nomiao">
              <span class="ni ni-bold-left" id="toc-miao"></span>
            </a>
        	<div class="card-img tu container container-lg py-5 toc">
        		<strong>文章目录</strong>
        		<div class="toc-list">
        		<? getCatalog(); ?>
        		</div>
        </div>
    </div>
    <script>
    	var onshow = false;
    	function tocshow(){
    		if(onshow){
    			$(".toc-container").css("right",'-175px')
    			$("#toc-miao").removeClass("ni-bold-right").addClass("ni-bold-left")
    		}else{
    			$(".toc-container").css("right",'-5px')
    			$("#toc-miao").removeClass("ni-bold-left").addClass("ni-bold-right")
    		}
    		onshow = !onshow
    	}
    	function jumpto(num){
    		$('html,body').animate({ scrollTop: $('[name="cl-'+num+'"]').offset().top-100 }, 500)
    	}
    	$("#toc-nomiao").click(tocshow)
    	<?php if($this->options->toc=="able"): ?>
    	$(document).ready(function() {     
			tocshow()
		}); 
    	<?php endif; ?>
    </script>
    <section class="section">
      <div class="container container-lg py-5" style="max-width: 1500px;">
        <div class="card card-profile shadow mt--250">
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
                <? if($this->hidden){ ?>
                
					<div class="container text-center">
						<form class="protected" id="protected" action="<?php $this -> permalink() ?>" method="post">
							<textarea name="text" style="display:none;"></textarea>
							<p class="lead">写一下密码啦</p>
							<div class="row justify-content-md-center">
								<div class="col col-10">
									<input class="form-control" type="password" name="protectPassword" id="protectPassword" placeholder="请输入密码">
								</div>
								<div class="col-md-auto">
									<button type="submit" class="btn btn-info" id="protectButton">确认</button>
								</div>
							</div>
						</form>
						<script>
						$("#protectPassword").on('focus',function(){
							$(this).removeClass("is-invalid")
            			})
						$("#protected").submit(function() {
							var secr = <? echo Typecho_Common::shuffleScriptVar(
            $this->security->getToken(clear_urlcan($this->request->getRequestUrl()))); ?>
							$("#protectButton").attr("disabled",true);
							$.ajax({
            					url: $(this).attr("action") + "?_=" + secr,
            					type: $(this).attr("method"),
            					data: $(this).serializeArray(),
            					complete: function(){
            						$("#protectButton").attr("disabled",false);	
            					},
            					error: function() {
                					
            					},
            					success: function(data) {
            						if(data){
            							var parser = new DOMParser()
                						var htmlDoc = parser.parseFromString(data, "text/html")
                						if(htmlDoc.title=="Error"){
                							$("#protectPassword").addClass("is-invalid")
                							
                						}else{
                							$("#protectPassword").addClass("is-valid")
                							$("#protected").fadeOut();
                							setTimeout(function(){
                								$("title").html(htmlDoc.title)
                								$("#main").html(htmlDoc.getElementById("main").innerHTML)
                							},1000)
                							
                						}
            						}
            					}
							})
							return false
						})
						
						</script>
					</div>
				<? }else{ ?>
                	<?php 
                	$content = preg_replace('/<img(.*?)src=[\'"]([^\'"]+)[\'"](.*?)>/i',"<noscript>\$0</noscript><img\$1data-original=\"\$2\" \$3>",$this->content); 
                	echo $content 
                	?>
                <? } ?>
                </div>
              </div>
            </div>
            <div class="border-top text-center">
            	<br>
            </div>
            
          </div>
        </div>
      </div>
      <div class="container container-lg">
		
      <div class="row">
        <div class="col-md-6 mb-5 mb-md-0">
          <div class="card card-lift--hover shadow border-0">
          	<?php thePrev($this,$this->options->randompicUrl); ?>
            
          </div>
        </div>
        <div class="col-md-6 mb-5 mb-lg-0">
          <div class="card card-lift--hover shadow border-0">
            <?php theNext($this,$this->options->randompicUrl); ?>
          </div>
        </div>
      </div>
    </div>
    </section>
    <? if(!$this->hidden && $this->allow('comment')) $this->need('comments.php'); ?>
  </main>



<?php $this->need('sidebar.php'); ?>

<?php $this->need('footer.php'); ?>
