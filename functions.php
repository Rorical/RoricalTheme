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
    $QQ = new Typecho_Widget_Helper_Form_Element_Text('QQ', NULL, NULL, _t('你的QQ'), _t('会放在首页'));
    $form->addInput($QQ);
    $Github = new Typecho_Widget_Helper_Form_Element_Text('Github', NULL, NULL, _t('你的Github'), _t('会放在首页'));
    $form->addInput($Github);
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

/*
function themeFields($layout) {
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $layout->addItem($logoUrl);
}
*/

function  art_count ($cid){
    $db=Typecho_Db::get ();
    $rs=$db->fetchRow ($db->select ('table.contents.text')->from ('table.contents')->where ('table.contents.cid=?',$cid)->order ('table.contents.cid',Typecho_Db::SORT_ASC)->limit (1));
    $text = preg_replace("/[^\x{4e00}-\x{9fa5}]/u", "", $rs['text']);
    echo mb_strlen($text,'UTF-8');
}
function get_post_view($archive)
{
	$cid = $archive->cid;
	$db = Typecho_Db::get();
	$prefix = $db->getPrefix();
	if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
		$db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
		echo 0;
		return;
	}
	$row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
	if ($archive->is('single')) {
		$db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
	}
	echo $row['views'];
}
function themeInit($archive)
{
 Helper::options()->commentsMaxNestingLevels = 999;//正常设置最高只有7层
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