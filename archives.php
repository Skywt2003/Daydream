<?php
/**
 * Sky 文章归档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>

<h1>文章归档</h1>
<?php Typecho_Widget::widget('Widget_Stat')->to($stat);?><?php $stat->publishedPostsNum() ?> 篇文章，<?php echo allOfCharacters();?> 文字。
<hr>
<?php echo exContent($this->content); ?>

<!-- <form class="grid" id="search" method="post" action="<?php $this->options->siteUrl();?>" role="search">
    <input type="search" id="search" name="search" placeholder="输入关键字搜索文章" />
</form> -->
<?php
    $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
    $year = 0; $mon = 0;
    while ($archives->next()):
        if (empty($archives->title) || $archives->title == " ") continue;
        $year_tmp = date('Y',$archives->created);
        $mon_tmp = date('m',$archives->created);
        if ($year != $year_tmp && $year > 0) $output .= '</ul>';
        if ($year != $year_tmp):
            $year = $year_tmp;
            $output .= '<h2>'. $year.'</h2><ul>';
        endif;
        $output .= '<li><time>'.date('m-d ',$archives->created).'</time> <a href="'.$archives->permalink .'">'. $archives->title .'</a>';
        if ($archives->commentsNum > 0) $output .= ' <small><i class="czs-talk-l"></i> '.$archives->commentsNum.'</small>';
        $output .= '</li>';
    endwhile;
    $output .= '</li>';
    echo $output;
?>

<?php $this->need('footer.php'); ?>