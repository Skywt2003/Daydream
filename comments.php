<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->levels > 0) $commentClass .= ' ml-5';
    ?>
    <?php if ($comments->type == 'pingback' || $comments->type == 'traceback'): ?>
	    <div id="<?php $comments->theId(); ?>">
            <div class="card">
                <div class="card-body">
                    <span class="font-weight-900"><?php $comments->author(); ?></span>
                    <br>
	                <span class="small"><?php $comments->date('F jS, Y'); ?> at <?php $comments->date('h:i a'); ?></span>
                </div>
            </div>
        </div>
    <?php else: ?>
	    <div id="<?php $comments->theId(); ?>" class="mt-3 mb-3<?php echo $commentClass; ?>">
	        <div>
                <?php
                    # 如果是 QQ 邮箱则使用 QQ 头像，否则请求 Gravatar 头像
                    $qq = str_replace('@qq.com', '', $comments->mail);
			        if (strstr($comments->mail, "qq.com") && is_numeric($qq) && strlen($qq) < 11 && strlen($qq) > 4){
			            $avatarUrl = 'https://q3.qlogo.cn/g?b=qq&nk='.$qq.'&s=100';
			        } else {
                        $avatarUrl = __TYPECHO_GRAVATAR_PREFIX__;
                        if (!empty($comments->mail)) $avatarUrl .= md5(strtolower(trim($comments->mail)));
                        $avatarUrl .= '?s='. '64' . '&amp;r=' . Helper::options()->commentsAvatarRating . '&amp;d=' . Helper::options()->themeUrl.'/assets/img/visitor.png';
                    }
                ?>
                <img class="avatar circle" src="<?php echo $avatarUrl; ?>" alt="<?php echo $comments->author; ?>"/>
                <div>
                    <b><?php $comments->author(); ?></b>
                    <?php if ($comments->authorId == $comments->ownerId): ?>
                        <span class="badge">博主</span>
                    <?php endif; ?>
                    <?php if ($comments->status == 'waiting'): ?>
                        <span class="badge"><i class="czs-talk"></i> 等待审核</span>
                    <?php endif; ?>
                    <?php showUserAgent($comments->agent); ?>
                    <small><?php showLocation($comments->ip); ?></small>
                    <br>
	                <small><?php $comments->date('F jS, Y'); ?> at <?php $comments->date('h:i a'); ?></small>
                    <small><?php $comments->reply('<i class="czs-pen-write"></i> Reply'); ?></small>
                </div>
            </div>
            <p><?php $comments->content(); ?></p>
            <?php if ($comments->children): $comments->threadedComments($options); endif; ?>
        </div>
    <?php endif; ?>
<?php } ?>

<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if ($comments->have()): ?>
    <hr>
    <?php $comments->listComments(array('before'=>'','after'=>'')); ?>
    <?php endif; ?>

    <!-- 评论提交区域 -->
    <?php if ($this->allow('comment')): ?>
        <hr>
        <div id="<?php $this->respondId(); ?>" class="respond">
            <div>
                <?php $comments->cancelReply('<i class="czs-close"></i> 取消回复'); ?>
            </div>
            <?php if ($this->options->commentsNotice !=''): ?>
                <div class="alert" role="alert">
                    <i class="czs-warning"></i>
                    <span><?php $this->options->commentsNotice(); ?></span>
                </div>
            <?php endif; ?>
        	<h2 id="response">添加新评论</h2>
        	<form method="post" action="<?php $this->commentUrl(); ?>" id="comment-form" role="form">
                <?php if ($this->user->hasLogin()): ?>
	    	    <p>登录身份：
                    <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a> | <a href="<?php $this->options->logoutUrl(); ?>" title="Logout">退出 &raquo;</a>
   	    	    </p>
                <?php else: ?>
                    <div class="grid">
                        <input type="text" name="author" id="author" placeholder="Name" value="<?php $this->remember('author'); ?>" required />
                        <input type="email" name="mail" id="mail" placeholder="Email" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
                        <input type="url" name="url" id="url" placeholder="Website" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
                    </div>
                <?php endif; ?>
                <textarea rows="8" cols="50" name="text" id="textarea" placeholder="Say something!" required ><?php $this->remember('text'); ?></textarea>
                <button class="shadow" type="submit">Submit</button>
                <label>
                    <input type="checkbox" role="switch" name="receiveMail" id="receiveMail" value="yes" checked />
                    <label for="receiveMail">接收邮件通知</label>
                </label>
        	</form>
        </div>
    <?php endif; ?>
</div>
