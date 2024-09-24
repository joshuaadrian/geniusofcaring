	<div class="share_page_modal">
        <a href="#" class="close">Close</a>
		<div class="inner">
			<h1>Share Page</h1>
			<span class="page_url"><?php
			if(is_home()){
				echo 'http://geniusofcaring.com/blog';
			} else {
				echo get_permalink();
			}
			?></span>
            <!-- Go to www.addthis.com/dashboard to customize your tools -->
            <div class="addthis_sharing_toolbox"></div>
		</div>
	</div>
	<div class="need_help_modal">
        <a href="#" class="close">Close</a>
		<form>
			<h1>Need some help setting up your story?</h1>
			<p>We&rsquo;re sorry you&rsquo;re having difficulty using this site. Please provide details below, and somebody will be in touch by email within 48 hours. Please indicate if you would prefer a response by phone.</p>
			<label for="help_your_email">Email</label>
			<input type="email" name="help_your_email" id="help_your_email">
			<label for="help_your_message">Message</label>
			<textarea name="help_your_message" id="help_your_message"></textarea>
			<input type="submit" value="submit" class="button">
		</form>
    </div>
    <div class="preorder_modal">
        <div class="preorder_content">

            <p class="impact">Save The Date</p>

            <p>Official site launch & free streaming of The Genius of Marian begins this November, 2024. Please help us spread the word!</p>

            <p><a href="https://geniusofmarian.com/" target="_blank">Genius of Marian</a></p>

        </div>
        <span class="close">Close</span>
    </div>
    <div id="fb-root"></div>
    <a href="https://geniusofmarian.com/contact" target="_blank" class="need_help_button">Need Help?</a>
<!-- Quantcast Tag --> 
<script type="text/javascript"> var _qevents = _qevents || []; (function() { var elem = document.createElement('script'); elem.src = (document.location.protocol == "https:" ? "https://secure" : "http://edge") + ".quantserve.com/quant.js"; elem.async = true; elem.type = "text/javascript"; var scpt = document.getElementsByTagName('script')[0]; scpt.parentNode.insertBefore(elem, scpt); })(); _qevents.push({ qacct:"p-BTG4tuu5WMrxQ" }); </script> <noscript> <div style="display:none;"> <img src="//pixel.quantserve.com/pixel/p-BTG4tuu5WMrxQ.gif" border="0" height="1" width="1" alt="Quantcast"/> </div> </noscript>
<!-- End Quantcast tag -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '808252585912279',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript"> 
var addthis_config = {
     data_track_clickback: false 
} 
</script> 
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54e22b945b4c2b8a" async="async"></script>
<?php
/*
 * The template for displaying the footer.
 */
    wp_footer();
?>
    </body>
</html>
