<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<div class="container card shadow py-5 comments">
	<div class="d-flex px-3">
              <div>
                <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                  <i class="ni ni-building text-primary"></i>
                </div>
              </div>
              <div class="pl-4">
                <h4 class="display-3">评论区</h4>
                <p><?php $this->commentsNum('完全没人呢', '只有一个人', '%d 条评论呢 '); ?></p>
            </div>
                        <?php $this->comments()->to($comments); ?>
            
<?php function threadedComments($comments, $options) {
	
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
 
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    

?>
 
<div id="<?php $comments->theId(); ?>" class="card shadow shadow-lg--hover mt-2<?php 
if ($comments->levels > 0) {
    echo ' comment-child';
    $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
} else {
    echo ' comment-parent';
}

$comments->alt(' comment-odd', ' comment-even');

echo $commentClass;
?>">
        
    <div class="card-body">
        <div class="d-flex px-3">
                  <div>
                    <a class="card-profile-image bg-gradient-success rounded-circle text-white">
                    	<? $comments->gravatar('40', '',NULL,"rounded-circle"); ?>
                    </a>
                  </div>
                  <div class="pl-4">
                  	
                    <h5 class="title text-success breakword"><span class="badge badge-pill badge-primary"><?php echo $comments->levels(); ?>.</span><?php $comments->author(); ?></h5>
                    <a class="text-success breakword"><?php $comments->date('Y F jS '); ?></a>
                    <?php  
					if($comments->parent){
    						$p_comment = getPermalinkFromCoid($comments->parent);   
    						$p_author = $p_comment['author'];   
    						$p_text = mb_strimwidth(strip_tags($p_comment['text']), 0, 100,"...");   
    						$p_href = $p_comment['href'];   
    						echo "<a href='$p_href' title='$p_text'>@$p_author</a>";   
						}   
						?> 
                    <p class="breakword"><?php $comments->content(); ?></p>
                    <?php $comments->reply('<i class="fa fa-reply"></i>'); ?>
                  </div>
                  </div>
                  <?php if ($comments->children) { ?>
                  <? if($comments->sequence<2){ ?>
                  
                  <?php $comments->threadedComments($options); ?>
                  </div>
					</div>
                  <? }else{ ?>
        		</div>
				</div>
				<?php $comments->threadedComments($options); ?>
        		  <? } ?>
        		  <? }else{ ?>
        		</div>
				</div>
				<?php } ?>
<?php } ?>

        </div>
        <?php $comments->listComments(); ?>
        
        <?php if($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="py-3">
        
        <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form"> 
        <div class="container mt-5">
        <div class="card bg-gradient-warning shadow-lg border-0">
          <div class="p-5">
            <div class="row align-items-center">
            
              <div class="col-lg-8">
                <h3 class="text-white"><?php _e('添加新评论'); ?></h3>
                <?php if($this->user->hasLogin()): ?>
                <textarea class="form-control form-control-alternative" name="text" id="textarea" rows="8" required placeholder="<?php $this->user->screenName(); ?>? 写点什么吧..."></textarea>
                <?php else: ?>
                <div class="row lead text-white mt-3">
    				<div class="col-md-4">
    					<div class="form-group">
        					<input class="form-control form-control-alternative" name="author" id="author" required value="<?php $this->remember('author'); ?>" placeholder="昵称">
    					</div>
    					</div>
    					<div class="col-md-4">
    					<div class="form-group">
        					<input type="email" name="mail" id="mail" placeholder="邮箱" value="<?php $this->remember('mail'); ?>"  class="form-control form-control-alternative" required/>
    					</div>
    					</div>
    					<div class="col-md-4">
    					<div class="form-group">
        					<input type="url" name="url" id="url" value="<?php $this->remember('url'); ?>" placeholder="网站" value="<?php $this->remember('mail'); ?>"  class="form-control form-control-alternative" />
    					</div>
    					</div>
					</div>
					<textarea class="form-control form-control-alternative" name="text" id="textarea" rows="8" required placeholder="写点什么吧..."></textarea>
					<?php endif; ?>
					  
              </div>
              
              <div class="col-lg-3 ml-lg-auto mt-3">
                <button class="btn btn-lg btn-block btn-white" type="submit" class="submit">提交！</button>
                <div class="cancel-comment-reply mt-5 align-items-center">
        			<?php $comments->cancelReply("取消回复","btn btn-danger"); ?>
        		</div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </form>
      </div>
      <?php endif; ?>
        
        <div id="comments" class="card-body">
	
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>

    <?php endif; ?>


    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>
            
    </div>
    
    
</div>
</div>



