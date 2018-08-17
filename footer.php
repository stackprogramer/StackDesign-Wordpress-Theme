</div>
<!-- /.container -->

<footer class="blog-footer"> 
  <?php 
  $copyright_footer_text = get_theme_mod( 'copyright_footer_text', 'default' );
    if(isset($copyright_footer_text) && $copyright_footer_text != null )
    echo $copyright_footer_text;
    else
    echo"©".date(' Y').'  '.get_bloginfo( 'name' ); ?>
  <p><a href="http://getbootstrap.com">Bootstrap</a> wordpress blog template   by <a href="https://twitter.com/stackprogramer">@stackprogramer</a>. <a  href="<?php echo get_site_url(); ?>">stack design</a></p>
  <p> <a href="#">Back to top</a> </p>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<div class="corner-ribbon bottom-right  sticky  shadow"><a href="http://cheatsheet.blogfa.com/"style="color:white;">وبلاگ چیت شیت</a> </div>
<?php wp_footer(); ?>
 </body>
</html>