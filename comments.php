<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php $this->comments()->to($comments); ?>

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
                  <div class="pl-4" style="width:90%;">
                  	
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
                    <?php if ($comments->status == 'waiting') { ?>
						<span class="badge badge-pill badge-default text-white">评论审核ing...</span>
					<?php } ?>
                    <?php $comments->reply('<i class="fa fa-reply"></i>'); ?>
                  </div>
                  </div>
                  <?php if ($comments->children) { ?>
                  <? if($comments->levels<1){ ?>
                  
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
        <div id="comment-refresh">
        <?php $comments->listComments(); ?>
        </div>
        <?php if($this->allow('comment')): ?>
        <div id="<?php $this->respondId(); ?>" class="py-3 comment-text">
        
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
    					<div class="form-group input-group input-group-alternative">
        					<div class="input-group-prepend">
            					<span class="input-group-text" style="padding: .4rem .5rem;">
            						<div id="author-head" class="icon-shape rounded-circle text-white gravatar" style="width: 2rem;height: 2rem;"></div>
            						</span>
        					</div>
        					<input class="form-control form-control-alternative" name="author" id="author" required="" value="" placeholder="昵称">
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
                <button class="btn btn-lg btn-block btn-white" type="submit" id="add-comment-button">提交！</button>
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
        <div id="comments" class=""><?php $this->comments()->to($comments); ?><?php if ($comments->have()): ?><?php $comments->pageNav('<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'pagination agination-lg justify-content-center', 'itemTag' => 'li', 'textTag' => 'a', 'currentClass' =>  'page-item active','prevClass' => 'page-item','nextClass' => 'page-item','linkClass' => 'page-link','itemClass' => 'page-item')); ?><?php endif; ?></div></div>
<script>var r = document.getElementById('<? $this->respondId() ?>'),
        input = document.createElement('input');
        input.type = 'hidden';
        input.name = '_';
        input.value = <?php echo Typecho_Common::shuffleScriptVar(
            $this->security->getToken(clear_urlcan($this->request->getRequestUrl()))); ?>

        if (null != r) {
            var forms = r.getElementsByTagName('form');
            if (forms.length > 0) {
                forms[0].appendChild(input);
            }
        }
        </script>
    <?
    echo $this->pluginHandle()->header("", $this);?>
    <script>
    $("#mail").on('blur',function(){
    	
    	url = "https://secure.gravatar.com/avatar/" + hex_md5($(this).val()) + "?s=40&d="
    	$("#author-head").css('background-image','url(' + url + ')'); 
    })
    
    function bindsubmit(){
		$("#comment-form").submit(function() {
			$("#add-comment-button").attr("disabled",true);
			$.ajax({
            url: $(this).attr("action"),
            type: $(this).attr("method"),
            data: $(this).serializeArray(),
            complete: function(){
            	$("#add-comment-button").attr("disabled",false);	
            },
            error: function() {
                
            },
            success: function(data) { 
                var parser = new DOMParser()
                var htmlDoc = parser.parseFromString(data, "text/html")
                if(htmlDoc.getElementById("comment-refresh")){
                ele = document.getElementsByClassName("comment-text")[0]
                elehtml = document.getElementsByClassName("comment-text")[0].innerHTML
                document.getElementById("comment-refresh").innerHTML = htmlDoc.getElementById("comment-refresh").innerHTML
                if(!document.getElementsByClassName("comment-text")[0]){
                	ele.innerHTML=elehtml
                	ele.children[0].children[0].children[0].children[0].children[0].getElementsByClassName("col-lg-3")[0].getElementsByClassName("cancel-comment-reply")[0].children[0].style.cssText="display:none;"
                	
                	document.getElementsByClassName("comments")[0].appendChild(ele)
                	bindsubmit()
                	console.log(emojify)
                	if(typeof emojify != "undefined"){
                		setTimeout(function() {
                			emojify.run();
                			
                		}, 1000);
                	}
                }
                }else{
                	
                }
                
            }
        })
        return false;
		})
		}
		bindsubmit()
		
    </script>
    <script type="text/javascript">
    (function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
    
        create : function (tag, attr) {
            var el = document.createElement(tag);
        
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
        
            return el;
        },

        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<? $this->respondId() ?>'), input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];

            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }

            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }

            return false;
        },

        cancelReply : function () {
            var response = this.dom('<? $this->respondId() ?>'),
            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null != input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
if(window.onload){window.onload()}

</script>

