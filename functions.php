<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;


function themeConfig($form) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点 LOGO 地址'), _t('在这里填入一个图片 URL 地址, 以在网站标题前加上一个 LOGO'));
    $form->addInput($logoUrl);
    $AvatarUrl = new Typecho_Widget_Helper_Form_Element_Text('AvatarUrl', NULL, NULL, _t('你的大头'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($AvatarUrl);
    
    $pcbackgroundUrl = new Typecho_Widget_Helper_Form_Element_Text('pcbackgroundUrl', NULL, NULL, _t('电脑主页背景'), _t('在这里填入电脑的背景图片 URL 地址'));
    $mobilebackgroundUrl = new Typecho_Widget_Helper_Form_Element_Text('mobilebackgroundUrl', NULL, NULL, _t('手机主页背景'), _t('在这里填入手机的背景图片 URL 地址'));
    $form->addInput($pcbackgroundUrl);
    $form->addInput($mobilebackgroundUrl);
    
    $randompicUrl = new Typecho_Widget_Helper_Form_Element_Text('randompicUrl', NULL, NULL, _t('随机图片'), _t('在这里填入一个图片 URL 地址'));
    $form->addInput($randompicUrl);
    
    $powermode = new Typecho_Widget_Helper_Form_Element_Radio('powermode',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('PowerMode打字特效'), _t('默认禁止，可以打开'));
    $form->addInput($powermode);
    $clickanime = new Typecho_Widget_Helper_Form_Element_Radio('clickanime',
        array('able' => _t('启用'),
            'disable' => _t('禁止'),
        ),
        'disable', _t('鼠标点击特效'), _t('默认禁止，也可以打开'));
    $form->addInput($clickanime);
    
    $Analytic = new Typecho_Widget_Helper_Form_Element_Textarea('Analytic', NULL, NULL, _t('填写什么网站记录代码，类似Google Analytics等'), _t('给你加进Header，可以不填'));
    $form->addInput($Analytic);
    
    $navbarIcons = new Typecho_Widget_Helper_Form_Element_Textarea('navbarIcons', NULL, _t('fa fa-github$$Github$$https://github.com/Liupaperbox/'), _t('自定义主页上面的标志，输错就爆炸哦'), _t('一行一个，格式为：图标的class$$显示文字$$点击跳转的链接'));
    $form->addInput($navbarIcons);
    
    $navbar = new Typecho_Widget_Helper_Form_Element_Radio('navbar',
        array('able' => _t('下拉式'),
            'disable' => _t('平铺式'),
        ),
        'able', _t('网站导航栏对于独立页面的表现形式'), _t('默认为下拉式，不习惯可以改成和别的博客一样的平铺式'));
    $form->addInput($navbar);
    
    $toc = new Typecho_Widget_Helper_Form_Element_Radio('toc',
        array('able' => _t('开启'),
            'disable' => _t('关闭'),
        ),
        'disable', _t('文章侧边的导航默认开不开'), _t('默认为关闭'));
    $form->addInput($toc);
}

function createCatalog($obj) {    //为文章标题添加锚点
    global $catalog;
    global $catalog_count;
    $catalog = array();
    $catalog_count = 0;
    $obj = preg_replace_callback('/<h([1-6])(.*?)>(.*?)<\/h\1>/i', function($obj) {
        global $catalog;
        global $catalog_count;
        $catalog_count ++;
        $catalog[] = array('text' => trim(strip_tags($obj[3])), 'depth' => $obj[1], 'count' => $catalog_count);
        return '<h'.$obj[1].$obj[2].'><a name="cl-'.$catalog_count.'"></a>'.$obj[3].'</h'.$obj[1].'>';
    }, $obj);
    return $obj;
}

function getCatalog() {    //输出文章目录容器
    global $catalog;
    $index = '';
    if ($catalog) {
        $index = '<ul>'."\n";
        $prev_depth = '';
        $to_depth = 0;
        foreach($catalog as $catalog_item) {
            $catalog_depth = $catalog_item['depth'];
            if ($prev_depth) {
                if ($catalog_depth == $prev_depth) {
                    $index .= '</li>'."\n";
                } elseif ($catalog_depth > $prev_depth) {
                    $to_depth++;
                    $index .= '<ul>'."\n";
                } else {
                    $to_depth2 = ($to_depth > ($prev_depth - $catalog_depth)) ? ($prev_depth - $catalog_depth) : $to_depth;
                    if ($to_depth2) {
                        for ($i=0; $i<$to_depth2; $i++) {
                            $index .= '</li>'."\n".'</ul>'."\n";
                            $to_depth--;
                        }
                    }
                    $index .= '</li>';
                }
            }
            $index .= '<li><a href="javascript:jumpto('.$catalog_item['count'].')">'.$catalog_item['text'].'</a>';
            $prev_depth = $catalog_item['depth'];
        }
        for ($i=0; $i<=$to_depth; $i++) {
            $index .= '</li>'."\n".'</ul>'."\n";
        }
    }
    echo $index;
}
class Typecho_Widget_Helper_PageNavigator_Box extends Typecho_Widget_Helper_PageNavigator {
	/**
     * 输出盒装样式分页栏
     *
     * @access public
     * @param string $prevWord 上一页文字
     * @param string $nextWord 下一页文字
     * @param int $splitPage 分割范围
     * @param string $splitWord 分割字符
     * @param string $currentClass 当前激活元素class
     * @return void
     */
	public function render($prevWord = 'PREV', $nextWord = 'NEXT', $splitPage = 3, $splitWord = '...', array $template = array()) {
		if ($this->_total < 1) {
			return;
		}
		$default = array(
		            'itemTag'       =>  'li',
		            'textTag'       =>  'span',
		            'currentClass'  =>  'current',
		            'prevClass'     =>  'prev',
		            'nextClass'     =>  'next'
		        );
		$template = array_merge($default, $template);
		extract($template);
		// 定义item
		$itemClass = empty($itemClass) ? '' : ('class="' . $itemClass . '"');
		$itemBegin = empty($itemTag) ? '' : ('<' . $itemTag . ' ' . $itemClass . ' >');
		$itemCurrentBegin = empty($itemTag) ? '' : ('<' . $itemTag 
		            . (empty($currentClass) ? '' : ' class="' . $currentClass . '"') . '>');
		$itemPrevBegin = empty($itemTag) ? '' : ('<' . $itemTag 
		            . (empty($prevClass) ? '' : ' class="' . $prevClass . '"') . '>');
		$itemNextBegin = empty($itemTag) ? '' : ('<' . $itemTag 
		            . (empty($nextClass) ? '' : ' class="' . $nextClass . '"') . '>');
		$itemEnd = empty($itemTag) ? '' : ('</' . $itemTag . '>');
		$textBegin = empty($textTag) ? '' : ('<' . $textTag . '>');
		$textEnd = empty($textTag) ? '' : ('</' . $textTag . '>');
		$linkClass = empty($linkClass) ? '' : ('class="' . $linkClass . '"');
		$linkBegin = '<a href="%s"' . $linkClass . '>';
		$linkCurrentBegin = empty($itemTag) ? ('<a href="%s"'
		            . (empty($currentClass) ? '' : ' class="' . $currentClass . '"') . '>')
		            : $linkBegin;
		$linkPrevBegin = empty($itemTag) ? ('<a href="%s"'
		            . (empty($prevClass) ? '' : ' class="' . $prevClass . '"') . '>')
		            : $linkBegin;
		$linkNextBegin = empty($itemTag) ? ('<a href="%s"'
		            . (empty($nextClass) ? '' : ' class="' . $nextClass . '"') . '>')
		            : $linkBegin;
		$linkEnd = '</a>';
		$from = max(1, $this->_currentPage - $splitPage);
		$to = min($this->_totalPage, $this->_currentPage + $splitPage);
		//输出上一页
		if ($this->_currentPage > 1) {
			echo $itemPrevBegin . sprintf($linkPrevBegin,
			                str_replace($this->_pageHolder, $this->_currentPage - 1, $this->_pageTemplate) . $this->_anchor)
			                . $prevWord . $linkEnd . $itemEnd;
		}
		//输出第一页
		if ($from > 1) {
			echo $itemBegin . sprintf($linkBegin, str_replace($this->_pageHolder, 1, $this->_pageTemplate) . $this->_anchor)
			                . '1' . $linkEnd . $itemEnd;
			if ($from > 2) {
				//输出省略号
				echo $itemBegin . $textBegin . $splitWord . $textEnd . $itemEnd;
			}
		}
		//输出中间页
		for ($i = $from; $i <= $to; $i ++) {
			$current = ($i == $this->_currentPage);
			echo ($current ? $itemCurrentBegin : $itemBegin) . sprintf(($current ? $linkCurrentBegin : $linkBegin),
			                str_replace($this->_pageHolder, $i, $this->_pageTemplate) . $this->_anchor)
			                . $i . $linkEnd . $itemEnd;
		}
		//输出最后页
		if ($to < $this->_totalPage) {
			if ($to < $this->_totalPage - 1) {
				echo $itemBegin . $textBegin . $splitWord . $textEnd . $itemEnd;
			}
			echo $itemBegin . sprintf($linkBegin, str_replace($this->_pageHolder, $this->_totalPage, $this->_pageTemplate) . $this->_anchor)
			                . $this->_totalPage . $linkEnd . $itemEnd;
		}
		//输出下一页
		if ($this->_currentPage < $this->_totalPage) {
			echo $itemNextBegin . sprintf($linkNextBegin,
			                str_replace($this->_pageHolder, $this->_currentPage + 1, $this->_pageTemplate) . $this->_anchor)
			                . $nextWord . $linkEnd . $itemEnd;
		}
	}
}


function themeFields($layout) {
    $pic = new Typecho_Widget_Helper_Form_Element_Text('pic', NULL, NULL, _t('文章头图'), _t('在这里填入一个图片URL地址'));
    $layout->addItem($pic);
}


function  art_count ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    echo mb_strlen($text,'UTF-8');
}

function themeInit($archive)
{
 Helper::options()->commentsMaxNestingLevels = 999;//正常设置最高只有7层
 if ($archive->is('single')) {
        $archive->content = createCatalog($archive->content);
    }
}
function getPermalinkFromCoid($coid) {//留言加@  
$db       = Typecho_Db::get();   
$options  = Typecho_Widget::widget('Widget_Options');   
$contents = Typecho_Widget::widget('Widget_Abstract_Contents');   
$row = $db->fetchRow($db->select('cid, type, author, text')->from('table.comments')->where('coid = ? AND status = ?', $coid, 'approved'));   
if (empty($row)) return 'Comment not found!';   
    $cid = $row['cid'];   
    $select = $db->select('coid, parent')->from('table.comments')->where('cid = ? AND status = ?', $cid, 'approved')->order('coid');   
if ($options->commentsShowCommentOnly)   
    $select->where('type = ?', 'comment');   
    $comments = $db->fetchAll($select);   
if ($options->commentsOrder == 'DESC')   
    $comments = array_reverse($comments);   
foreach ($comments as $key => $val)   
    $array[$val['coid']] = $val['parent'];   
    $i = $coid;   
while ($i != 0) {   
    $break = $i;   
    $i = $array[$i];   
}   
$count = 0;   
foreach ($array as $key => $val) {   
    if ($val == 0) $count++;    
    if ($key == $break) break;    
}   
$parentContent = $contents->push($db->fetchRow($contents->select()->where('table.contents.cid = ?', $cid)));   
$permalink = rtrim($parentContent['permalink'], '/');   
$page = ($options->commentsPageBreak)? '/comment-page-' . ceil($count / $options->commentsPageSize) : ( substr($permalink, -5, 5) == '.html' ? '' : '/' );   
return array(   
    "author" => $row['author'],   
    "text" => $row['text'],   
    "href" => "{$permalink}{$page}#{$row['type']}-{$coid}"  
);   
}
/**
* 上一篇
* @access public
* @param string $default 如果没有上一篇,显示的默认文字
* @return void
*/
function theNext($widget, $randompicUrl)
{
  $db = Typecho_Db::get();
  $sql = $db->select()->from('table.contents')
  ->where('table.contents.created > ?', $widget->created)
  ->where('table.contents.status = ?', 'publish')
  ->where('table.contents.type = ?', $widget->type)
  ->where('table.contents.password IS NULL')
  ->order('table.contents.created', Typecho_Db::SORT_ASC)
  ->limit(1);
  $content = $db->fetchRow($sql);

  if ($content) {
  $widget->widget('Widget_Archive@cid'.$content["cid"], 'pageSize=1&type=post', 'cid='.$content["cid"])->to($ji);
  $pic = $ji->fields->pic ? $ji->fields->pic:$randompicUrl . "?_=" . mt_rand();
  $link = '<a class="carousel" href="'.$ji->permalink.'" title="'.$ji->title.'"><div style="background-image:url('.$pic.');" class="card-img tu"></div><div class="carousel-indicators"><h2 class="heading-title text-info blackback" style="text-transform:none;">'.$ji->title.'</h2><i class="ni ni-bold-right"></i></div></a>';
  echo $link;
  } else {
  $link = '<a class="carousel" title="没啦"><div style="background-image:url('.$randompicUrl.');" class="card-img tu"></div><div class="carousel-indicators"><h3 class="heading-title text-info blackback" style="text-transform:none;">没啦</h3></div></a>';
  echo $link;
  }
}
 
/**
* 下一篇
* @access public
* @param string $default 如果没有下一篇,显示的默认文字
* @return void
*/
function thePrev($widget, $randompicUrl)
{
  $db = Typecho_Db::get();
  $sql = $db->select()->from('table.contents')
  ->where('table.contents.created < ?', $widget->created)
  ->where('table.contents.status = ?', 'publish')
  ->where('table.contents.type = ?', $widget->type)
  ->where('table.contents.password IS NULL')
  ->order('table.contents.created', Typecho_Db::SORT_DESC)
  ->limit(1);
  $content = $db->fetchRow($sql);
  if ($content) {
  $widget->widget('Widget_Archive@cid'.$content["cid"], 'pageSize=1&type=post', 'cid='.$content["cid"])->to($ji);
  $pic = $ji->fields->pic ? $ji->fields->pic:$randompicUrl . "?_=" . mt_rand();
  $link = '<a class="carousel" href="'.$ji->permalink.'" title="'.$ji->title.'"><div style="background-image:url('.$pic.');" class="card-img tu"></div><div class="carousel-indicators"><i class="ni ni-bold-left"></i><h2 class="heading-title text-info blackback" style="text-transform:none;">'.$ji->title.'</h2></div></a>';
  // $link 输出的为翻页的样式
  echo $link;
  } else {
  $link = '<a title="没啦" class="carousel"><div style="background-image:url('.$randompicUrl.');" class="card-img tu"></div><div class="carousel-indicators"><h3 class="heading-title text-info blackback" style="text-transform:none;">没啦</h3></div></a>';
  echo $link;
  }
}

class Widget_Comments_Archive extends Widget_Abstract_Comments
{
    /**
     * 当前页
     *
     * @access private
     * @var integer
     */
    private $_currentPage;

    /**
     * 所有文章个数
     *
     * @access private
     * @var integer
     */
    private $_total = false;

    /**
     * 子父级评论关系
     *
     * @access private
     * @var array
     */
    private $_threadedComments = array();

    /**
     * _singleCommentOptions  
     * 
     * @var mixed
     * @access private
     */
    private $_singleCommentOptions = NULL;

    /**
     * 构造函数,初始化组件
     *
     * @access public
     * @param mixed $request request对象
     * @param mixed $response response对象
     * @param mixed $params 参数列表
     * @return void
     */
    public function __construct($request, $response, $params = NULL)
    {
        parent::__construct($request, $response, $params);
        $this->parameter->setDefault('parentId=0&commentPage=0&commentsNum=0&allowComment=1');
    }
    
    /**
     * 评论回调函数
     * 
     * @access private
     * @return void
     */
    private function threadedCommentsCallback()
    {
        $singleCommentOptions = $this->_singleCommentOptions;
        if (function_exists('threadedComments')) {
            return threadedComments($this, $singleCommentOptions);
        }
        
        $commentClass = '';
        if ($this->authorId) {
            if ($this->authorId == $this->ownerId) {
                $commentClass .= ' comment-by-author';
            } else {
                $commentClass .= ' comment-by-user';
            }
        }
?>
<li itemscope itemtype="http://schema.org/UserComments" id="<?php $this->theId(); ?>" class="comment-body<?php
    if ($this->levels > 0) {
        echo ' comment-child';
        $this->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $this->alt(' comment-odd', ' comment-even');
    echo $commentClass;
?>">
    <div class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">
        <span itemprop="image"><?php $this->gravatar($singleCommentOptions->avatarSize, $singleCommentOptions->defaultAvatar); ?></span>
        <cite class="fn" itemprop="name"><?php $singleCommentOptions->beforeAuthor();
        $this->author();
        $singleCommentOptions->afterAuthor(); ?></cite>
    </div>
    <div class="comment-meta">
        <a href="<?php $this->permalink(); ?>"><time itemprop="commentTime" datetime="<?php $this->date('c'); ?>"><?php $singleCommentOptions->beforeDate();
        $this->date($singleCommentOptions->dateFormat);
        $singleCommentOptions->afterDate(); ?></time></a>
        <?php if ('waiting' == $this->status) { ?>
        <em class="comment-awaiting-moderation"><?php $singleCommentOptions->commentStatus(); ?></em>
        <?php } ?>
    </div>
    <div class="comment-content" itemprop="commentText">
    <?php $this->content(); ?>
    </div>
    <div class="comment-reply">
        <?php $this->reply($singleCommentOptions->replyWord); ?>
    </div>
    <?php if ($this->children) { ?>
    <div class="comment-children" itemprop="discusses">
        <?php $this->threadedComments(); ?>
    </div>
    <?php } ?>
</li>
<?php
    }
    
    /**
     * 获取当前评论链接
     *
     * @access protected
     * @return string
     */
    protected function ___permalink()
    {

        if ($this->options->commentsPageBreak) {            
            $pageRow = array('permalink' => $this->parentContent['pathinfo'], 'commentPage' => $this->_currentPage);
            return Typecho_Router::url('comment_page',
                        $pageRow, $this->options->index) . '#' . $this->theId;
        }
        
        return $this->parentContent['permalink'] . '#' . $this->theId;
    }

    /**
     * 子评论
     *
     * @access protected
     * @return array
     */
    protected function ___children()
    {
        return $this->options->commentsThreaded && !$this->isTopLevel && isset($this->_threadedComments[$this->coid]) 
            ? $this->_threadedComments[$this->coid] : array();
    }

    /**
     * 是否到达顶层
     *
     * @access protected
     * @return boolean
     */
    protected function ___isTopLevel()
    {
        return $this->levels > $this->options->commentsMaxNestingLevels - 2;
    }

    /**
     * 重载内容获取
     *
     * @access protected
     * @return void
     */
    protected function ___parentContent()
    {
        return $this->parameter->parentContent;
    }

    /**
     * 输出文章评论数
     *
     * @access public
     * @param string $string 评论数格式化数据
     * @return void
     */
    public function num()
    {
        $args = func_get_args();
        if (!$args) {
            $args[] = '%d';
        }

        $num = intval($this->_total);

        echo sprintf(isset($args[$num]) ? $args[$num] : array_pop($args), $num);
    }

    /**
     * 执行函数
     *
     * @access public
     * @return void
     */
    public function execute()
    {
        if (!$this->parameter->parentId) {
            return;
        }

        $commentsAuthor = Typecho_Cookie::get('__typecho_remember_author');
        $commentsMail = Typecho_Cookie::get('__typecho_remember_mail');
        $select = $this->select()->where('table.comments.cid = ?', $this->parameter->parentId)
        ->where('table.comments.status = ? OR (table.comments.author = ? AND table.comments.mail = ? AND table.comments.status = ?)', 'approved', $commentsAuthor, $commentsMail, 'waiting');
        $threadedSelect = NULL;
        
        if ($this->options->commentsShowCommentOnly) {
            $select->where('table.comments.type = ?', 'comment');
        }
        
        $select->order('table.comments.coid', 'ASC');
        $this->db->fetchAll($select, array($this, 'push'));
        
        /** 需要输出的评论列表 */
        $outputComments = array();
        
        /** 如果开启评论回复 */
        if ($this->options->commentsThreaded) {
        
            foreach ($this->stack as $coid => &$comment) {
                
                /** 取出父节点 */
                $parent = $comment['parent'];
            
                /** 如果存在父节点 */
                if (0 != $parent && isset($this->stack[$parent])) {
                
                    /** 如果当前节点深度大于最大深度, 则将其挂接在父节点上 */
                    if ($comment['levels'] >= $this->options->commentsMaxNestingLevels) {
                        $comment['levels'] = $this->stack[$parent]['levels'];
                        $parent = $this->stack[$parent]['parent'];     // 上上层节点
                        $comment['parent'] = $parent;
                    }
                
                    /** 计算子节点顺序 */
                    $comment['order'] = isset($this->_threadedComments[$parent]) 
                        ? count($this->_threadedComments[$parent]) + 1 : 1;
                
                    /** 如果是子节点 */
                    $this->_threadedComments[$parent][$coid] = $comment;
                } else {
                    $outputComments[$coid] = $comment;
                }
                
            }
        
            $this->stack = $outputComments;
        }
        
        /** 评论排序 */
        if ('DESC' == $this->options->commentsOrder) {
            $this->stack = array_reverse($this->stack, true);
            $this->_threadedComments = array_map('array_reverse', $this->_threadedComments);
        }
        
        /** 评论总数 */
        $this->_total = count($this->stack);
        
        /** 对评论进行分页 */
        if ($this->options->commentsPageBreak) {
            if ('last' == $this->options->commentsPageDisplay && !$this->parameter->commentPage) {
                $this->_currentPage = ceil($this->_total / $this->options->commentsPageSize);
            } else {
                $this->_currentPage = $this->parameter->commentPage ? $this->parameter->commentPage : 1;
            }
            
            /** 截取评论 */
            $this->stack = array_slice($this->stack,
                ($this->_currentPage - 1) * $this->options->commentsPageSize, $this->options->commentsPageSize);
            
            /** 评论置位 */
            $this->row = current($this->stack);
            $this->length = count($this->stack);
        }
        
        reset($this->stack);
    }

    /**
     * 将每行的值压入堆栈
     *
     * @access public
     * @param array $value 每行的值
     * @return array
     */
    public function push(array $value)
    {
        $value = $this->filter($value);
        
        /** 计算深度 */
        if (0 != $value['parent'] && isset($this->stack[$value['parent']]['levels'])) {
            $value['levels'] = $this->stack[$value['parent']]['levels'] + 1;
        } else {
            $value['levels'] = 0;
        }

        /** 重载push函数,使用coid作为数组键值,便于索引 */
        $this->stack[$value['coid']] = $value;
        $this->length ++;
        
        return $value;
    }

    /**
     * 输出分页
     *
     * @access public
     * @param string $prev 上一页文字
     * @param string $next 下一页文字
     * @param int $splitPage 分割范围
     * @param string $splitWord 分割字符
     * @param string $template 展现配置信息
     * @return void
     */
    public function pageNav($prev = '&laquo;', $next = '&raquo;', $splitPage = 3, $splitWord = '...', $template = '')
    {
        if ($this->options->commentsPageBreak && $this->_total > $this->options->commentsPageSize) {
            $default = array(
                'wrapTag'       =>  'ol',
                'wrapClass'     =>  'page-navigator'
            );

            if (is_string($template)) {
                parse_str($template, $config);
            } else {
                $config = $template;
            }

            $template = array_merge($default, $config);

            $pageRow = $this->parameter->parentContent;
            $pageRow['permalink'] = $pageRow['pathinfo'];

            $query = Typecho_Router::url('comment_page', $pageRow, $this->options->index);

            /** 使用盒状分页 */
            $nav = new Typecho_Widget_Helper_PageNavigator_Box($this->_total,
                $this->_currentPage, $this->options->commentsPageSize, $query);
            $nav->setPageHolder('commentPage');
            $nav->setAnchor('comments');
            
            echo '<' . $template['wrapTag'] . (empty($template['wrapClass']) 
                    ? '' : ' class="' . $template['wrapClass'] . '"') . '>';
            $nav->render($prev, $next, $splitPage, $splitWord, $template);
            echo '</' . $template['wrapTag'] . '>';
        }
    }

    /**
     * 递归输出评论
     *
     * @access protected
     * @return void
     */
    public function threadedComments()
    {
        $children = $this->children;
        if ($children) {
            //缓存变量便于还原
            $tmp = $this->row;
            $this->sequence ++;

            //在子评论之前输出
            echo $this->_singleCommentOptions->before;

            foreach ($children as $child) {
                $this->row = $child;
                $this->threadedCommentsCallback();
                $this->row = $tmp;
            }

            //在子评论之后输出
            echo $this->_singleCommentOptions->after;

            $this->sequence --;
        }
    }
    
    /**
     * 列出评论
     * 
     * @access private
     * @param mixed $singleCommentOptions 单个评论自定义选项
     * @return void
     */
    public function listComments($singleCommentOptions = NULL)
    {
        //初始化一些变量
        $this->_singleCommentOptions = Typecho_Config::factory($singleCommentOptions);
        $this->_singleCommentOptions->setDefault(array(
            'before'        =>  '',
            'after'         =>  '',
            'beforeAuthor'  =>  '',
            'afterAuthor'   =>  '',
            'beforeDate'    =>  '',
            'afterDate'     =>  '',
            'dateFormat'    =>  $this->options->commentDateFormat,
            'replyWord'     =>  _t('回复'),
            'commentStatus' =>  "_t('审核ing...')",
            'avatarSize'    =>  32,
            'defaultAvatar' =>  NULL
        ));
        $this->pluginHandle()->trigger($plugged)->listComments($this->_singleCommentOptions, $this);

        if (!$plugged) {
            if ($this->have()) {
                echo $this->_singleCommentOptions->before;
            
                while ($this->next()) {
                    $this->threadedCommentsCallback();
                }
            
                echo $this->_singleCommentOptions->after;
            }
        }
    }
    
    /**
     * 重载alt函数,以适应多级评论
     * 
     * @access public
     * @return void
     */
    public function alt()
    {
        $args = func_get_args();
        $num = func_num_args();
        
        $sequence = $this->levels <= 0 ? $this->sequence : $this->order;
        
        $split = $sequence % $num;
        echo $args[(0 == $split ? $num : $split) -1];
    }

    /**
     * 根据深度余数输出
     *
     * @access public
     * @param string $param 需要输出的值
     * @return void
     */
    public function levelsAlt()
    {
        $args = func_get_args();
        $num = func_num_args();
        $split = $this->levels % $num;
        echo $args[(0 == $split ? $num : $split) -1];
    }
    
    /**
     * 评论回复链接
     * 
     * @access public
     * @param string $word 回复链接文字
     * @return void
     */
    public function reply($word = '')
    {
        if ($this->options->commentsThreaded && !$this->isTopLevel && $this->parameter->allowComment) {
            $word = empty($word) ? _t('回复') : $word;
            $this->pluginHandle()->trigger($plugged)->reply($word, $this);
            
            if (!$plugged) {
                echo '<a href="javascript:;" rel="nofollow" onclick="return TypechoComment.reply(\'' .
                    $this->theId . '\', ' . $this->coid . ');">' . $word . '</a>';
            }
        }
    }
    
    /**
     * 取消评论回复链接
     * 
     * @access public
     * @param string $word 取消回复链接文字
     * @return void
     */
    public function cancelReply($word = '',$class = "")
    {
        if ($this->options->commentsThreaded) {
            $word = empty($word) ? _t('取消回复') : $word;
            $this->pluginHandle()->trigger($plugged)->cancelReply($word, $this);
            
            if (!$plugged) {
                $replyId = $this->request->filter('int')->replyTo;
                echo '<a class="' . $class . '" id="cancel-comment-reply-link" href="' . $this->parameter->parentContent['permalink'] . '#' . $this->parameter->respondId .
                '" rel="nofollow"' . ($replyId ? '' : ' style="display:none"') . ' onclick="return TypechoComment.cancelReply();">' . $word . '</a>';
            }
        }
    }
}
function clear_urlcan($url){
    $rstr='';
    $tmparr=parse_url($url);
    $rstr=empty($tmparr['scheme'])?'http://':$tmparr['scheme'].'://';
    $rstr.=$tmparr['host'].$tmparr['path'];
    return $rstr;
}
class Titleshow_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {}
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
public static function tshow($v, $obj) {
/** 如果访问权限被禁止【就是如果需要密码】 */
if ($v['hidden']){
$v['text'] = "输入密码才能看哦";
/** 跳过系统默认 */
$v['hidden'] = false;
/** 用于模板判断插件 */
$v['titleshow'] = true;
}
/** 返回数据 */
return $v; 
}

}
Typecho_Plugin::factory('Widget_Abstract_Contents')->filter = array('Titleshow_Plugin', 'tshow');



