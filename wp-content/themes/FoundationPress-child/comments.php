<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	<h4 id="comments"><?php comments_number('No Responses', 'One Response', '% Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h4>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>

	<ol class="commentlist">
	<?php wp_list_comments(); ?>
	</ol>

	<div class="navigation">
		<div class="alignleft"><?php previous_comments_link() ?></div>
		<div class="alignright"><?php next_comments_link() ?></div>
	</div>
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<!-- If comments are closed. -->
		<p class="nocomments">Comments are closed.</p>

	<?php endif; ?>
<?php endif; ?>


<?php if ( comments_open() ) : ?>

<div id="respond">

<h2><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h2>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( is_user_logged_in() ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>
<p>Your email address will not be published. Required fields are marked *</p>
<div class="grid-x grid-margin-x">

<div class="medium-6 cell"><input type="text" class="text-box" placeholder="Name*" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> /></div>


<div class="medium-6 cell"><input type="text" class="text-box" name="email" placeholder="Email*" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> /></div>


<div class="medium-12 cell"><input type="text" class="text-box" name="url" placeholder="Website" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" /></div>

<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<div class="medium-12 cell"><textarea name="comment" class="text-area" id="comment" cols="100%" rows="10" tabindex="4" placeholder="Comments"></textarea></div>

<div class="medium-12 cell">
	<label class="checkarea">Notify me of follow-up comments by email.
      <input type="checkbox">
      <span class="checkmark"></span>
    </label>
</div>
<div class="medium-12 cell">
<label class="checkarea">Notify me of follow-up comments by email.
  <input type="checkbox">
  <span class="checkmark"></span>
</label>
</div>


<div class="medium-12 cell"><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" class="submit" /></div>

<?php comment_id_fields(); ?>

</div>


<?php do_action('comment_form', $post->ID); ?>



</form>



<?php endif; // If registration required and not logged in ?>

<p class="p-0">This site uses Akismet to reduce spam. <br><span>Learn how your comment data is processed.</span></p>




<?php endif; // if you delete this the sky will fall on your head ?>
