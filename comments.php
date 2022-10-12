<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->levels > 0) $commentClass .= ' comment-ml';
    ?>
    <?php if ($comments->type == 'pingback' || $comments->type == 'traceback'): ?>
	    <blockquote id="<?php $comments->theId(); ?>">
            被 <?php $comments->author(); ?> 引用。
            <br>
	        <small><?php $comments->date('F jS, Y'); ?> at <?php $comments->date('h:i a'); ?></small>
        </blockquote>
    <?php else: ?>
	    <div id="<?php $comments->theId(); ?>" class="<?php echo $commentClass; ?>">
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
                    <small><i class="czs-forum-l"></i> 博主</small>
                <?php endif; ?>
                <?php showUserAgent($comments->agent); ?>
                <small><?php showLocation($comments->ip); ?></small>
                <small><?php $comments->reply('<i class="czs-pen-write"></i> Reply'); ?></small>
                <?php if ($comments->status == 'waiting'): ?>
                    <small><i class="czs-talk-l"></i> 等待审核</small>
                <?php endif; ?>
                <br>
	            <small><?php $comments->date('F jS, Y'); ?> at <?php $comments->date('h:i a'); ?></small>
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
            <div><?php $comments->cancelReply('<i class="czs-close"></i> 取消回复'); ?></div>
            <?php if ($this->options->commentsNotice !=''): ?>
                <div class="alert" role="alert"><?php $this->options->commentsNotice(); ?></div>
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
                <button id="submit" class="shadow" type="submit">Submit</button>
                <!-- <label>
                    <input type="checkbox" role="switch" name="receiveMail" id="receiveMail" value="yes" checked />
                    <label for="receiveMail">接收邮件通知</label>
                </label> -->
        	</form>
        </div>
        <script> // 从 Typecho 源码中摘取的评论 js
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
                            response = this.dom('<?php echo $this->respondId; ?>'), input = this.dom('comment-parent'),
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
                        var response = this.dom('<?php echo $this->respondId; ?>'),
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
        </script>
    <?php endif; ?>
</div>
