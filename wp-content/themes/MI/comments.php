<?php if ( post_password_required() ) : ?>
	<p><?php _e('输入密码以查看评论'); ?></p>
<?php return; endif; ?>
<div class="comments">
  <div class="comments_title">
    <b><?php comments_number(__('没有评论'), __('已有1条评论'), __('已有%条评论')); ?><?php if ( comments_open() ) : ?><small><a href="#comment" title="<?php _e("发表评论"); ?>">▼</a></small><?php endif; ?></b>
  </div>
<?php foreach ($comments as $comment) : //评论循环?>
  <div class="comments_list">
    <div class="comments_left">
      <?php
	  //取得评论者头像
	  $output=get_avatar(get_comment_author_email('comment_author_email'), 32);
	  echo $output;
	  ?>
    </div>
    <div class="commnets_right">
      <span><?php comment_author_link(); //取得讨论名称?></span><br />
      <span><?php comment_date(); //取得讨论日期?></span>
      <span class="comments_replay"></span>
    </div>
    <div style="clear:both;"></div>
    <div><?php comment_text(); //取得讨论内容?></div>
  </div>
<?php endforeach; ?>


  <?php if ( comments_open() ) : ?>
  <div class="respond">
  <div class="comments_title">
    <b>我来说两句</b>
  </div>
  <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
     <p><?php printf(__('你需要 <a href="%s">登录</a> 后才能进行讨论.'), get_option('siteurl')."/wp-login.php?redirect_to=".urlencode(get_permalink()));?></p>
  <?php else : ?>
  <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform" name="commentform">
    <div class="comments_input">
      <span>
      <input class="input_text" type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
      <label for="author"> 昵称<i>*</i></label>
      </span>
      <span>
      <input class="input_text" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
      <label for="email"> 邮箱<i>*</i></label>
      </span>
     <span> <input class="input_text" type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
      <label for="url"> 网址</label></span>
      <textarea name="comment" id="comment" class="input_comment" rows="5" tabindex="4"></textarea>
    
    <p>
      <input type="submit" id="submit" class="sub" tabindex="5" value="<?php echo attribute_escape(__('发表评论')); ?>" /><span style="color:#999; font-size:10px;">&nbsp;&nbsp;Ctrl+Enter</span>
    </p>
    </div>
    <?php comment_id_fields(); ?>
    <?php do_action('comment_form', $post->ID); ?>
  </form>
  <?php endif; // end?>
  <script type="text/javascript">
      <!--//--><![CDATA[//><!--
      var commenttextarea = document.getElementById('comment');
      commenttextarea.onkeydown = function quickSubmit(e) {
      if (!e) var e = window.event;
      if (e.ctrlKey && e.keyCode == 13){
      document.getElementById('submit').click();
      }
      };
      //--><!]]>
  </script>
  </div>
  <?php else : // 如果讨论关闭 ?>
  <p><?php _e('抱歉，评论被关闭'); ?></p>
  <?php endif; ?>
</div>