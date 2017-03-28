        <?php $uploads = wp_upload_dir();?>
        <footer>
            <div class="container">
                <div class="phone">
                    <a href="tel:<?php echo str_replace(' ', '', get_theme_mod('phone')); ?>" title="Call Us"><img src="<?php echo $uploads['baseurl'];?>/phone-icon.png" alt="Phone Icon"><?php echo get_theme_mod('phone'); ?></a>
                </div>
                <div class="phone">
                    <a href="mailto:<?php echo get_theme_mod('email'); ?>" title="Email Us"><img src="<?php echo $uploads['baseurl'];?>/email-icon.png" alt="Email Icon"><?php echo get_theme_mod('email'); ?></a>
                </div>
                <div class="phone">
                    <a href="<?php echo get_theme_mod('facebook'); ?>" title="Find us on Facebook"><img src="<?php echo $uploads['baseurl'];?>/facebook-icon.png" alt="Facebook Icon"></a>
                    <a href="<?php echo get_theme_mod('google'); ?>" title="Find us on Google+"><img src="<?php echo $uploads['baseurl'];?>/google-icon.png" alt="Google+ Icon"></a>
                    <a href="<?php echo get_theme_mod('linkedin'); ?>" title="Find us on LinkedIn"><img src="<?php echo $uploads['baseurl'];?>/linkedIn-icon.png" alt="LinkedIn Icon"></a>
                    <a href="<?php echo get_theme_mod('twitter'); ?>" title="Find us on Twitter"><img src="<?php echo $uploads['baseurl'];?>/twitter-icon.png" alt="Twitter Icon"></a>
                </div>
                <div class="disclaimer">
                    The following disclaimer is required of all solicitors providing information in the area of personal injury law:<br>
                    *In contentious business, a solicitor may no calculate fees or other charges as a percentage or proportion of any award or settlement.
                </div>
            </div>   
        </footer>
        <script src="<?php echo get_template_directory_uri ();?>/functions.js"></script>
        <script>
            jQuery(document).ready(function($){
                $('.menu-toggle').click(function(){
                    $('.menu-mainmenu-container').slideToggle('slow');
                });
            });
        </script>
        <?php wp_footer();?>
    </body>
</html> 