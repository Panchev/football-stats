<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<!--kode Wrapper Start-->  
<div class="kode_wrapper"> 
	<!--Header 2 Wrap Start-->
    <header class="kode_header_2">

        <div class="container">
            <!--Logo Bar Start-->
            <div class="kode_logo_bar">
                <!--Logo Start-->
                <div class="logo">
                    <a href="<?php echo home_url('/'); ?>">
                        <img src="<?php echo bloginfo('stylesheet_directory'); ?>/resources/images/logo.png" alt="">
                    </a>
                </div>
                <!--Logo Start-->
                <!--Navigation Wrap Start-->
                <div class="kode_navigation">
                
                    <ul class="nav">
                        <li><a href="<?php echo home_url('/'); ?>">home</a></li>
                        <?php 
                        $leagues = get_terms( [
                            'taxonomy' => 'crb_league',
                            'hide_empty' => false
                        ]);
                         
                        if ( $leagues ) : ?>
                            <li>
                                <a href="#"><?php _e( 'Leagues', 'crb' ); ?></a>
                                <ul class="dl-menu">
                                    <?php foreach ( $leagues as $league ) : ?>
                                        <li>
                                            <a href="<?php echo get_term_link( $league, 'crb_league') ?>"><?php echo $league->name; ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endif; ?> 
                    </ul>

                    <div id="kode-responsive-navigation" class="dl-menuwrapper">
                        <button class="dl-trigger">Open Menu</button>
                        <ul class="dl-menu">
                            <li><a href="index.html">home</a></li>
                            <li class="menu-item kode-parent-menu">
                                <a href="#">Fixtures & Results</a>
                                <ul class="dl-submenu">
                                    <li><a href="latest-result.html">latest result</a></li>
                                    <li><a href="team-schedule.html">teamschedule</a></li>
                                </ul>
                            </li>
                            <li class="menu-item kode-parent-menu"><a href="#">blog</a>
                                <ul class="dl-submenu">
                                    <li>
                                        <a href="#">blog 1</a>
                                        <ul class="dl-submenu">
                                            <li><a href="blog-grid-2.html">blog 2</a></li>
                                            <li><a href="blog_grid-3.html">blog 3</a></li>
                                            <li><a href="blog-grid-4.html">blog 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">blog 2</a>
                                        <ul class="dl-submenu">
                                            <li><a href="blog2-grid-2.html">blog 2</a></li>
                                            <li><a href="blog2-grid-3.html">blog 3</a></li>
                                            <li><a href="blog2-grid-4.html">blog 4</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="#">blog 3</a>
                                        <ul class="dl-submenu">
                                            <li><a href="blog3-grid-2.html">blog 2</a></li>
                                            <li><a href="blog3-grid-3.html">blog 3</a></li>
                                            <li><a href="blog3-grid-4.html">blog 4</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="blog-grid-with-sidebar.html">blog grid</a></li>
                                    <li><a href="blog-large-with-sidebar.html">blog large</a></li>
                                    <li><a href="blog-listing-with-sidebar.html">blog listing</a></li>
                                    <li><a href="blog-detail.html">blog detail</a></li>
                                </ul>
                            </li>
                            <li class="menu-item kode-parent-menu"><a href="#">team</a>
                                <ul class="dl-submenu">
                                    <li><a href="team-overview.html">team overview</a></li>
                                    <li><a href="team-roster.html">team roster</a></li>
                                    <li><a href="team-schedule.html">team schedule</a></li>
                                    <li><a href="team-standing.html">team standing</a></li>
                                    <li><a href="team-comparison.html">team comparison</a></li>
                                    <li><a href="teamdetails.html">team details</a></li>
                                </ul>
                            </li>
                            <li class="menu-item kode-parent-menu"><a href="#">player</a>
                                <ul class="dl-submenu">
                                    <li><a href="player-detail.html">player detail</a></li>
                                <li><a href="players-standing.html">players standing</a></li>
                                </ul>
                            </li>
                            <li class="menu-item kode-parent-menu"><a href="#">pages</a>
                                <ul class="dl-submenu">
                                    <li><a href="ticket.html">ticket</a></li>
                                    <li><a href="shop.html">shop</a></li>
                                    <li><a href="ticket-detail.html">ticket detail</a></li>
                                    <li><a href="404.html">404</a></li>
                                    <li><a href="comingsoon.html">comingsoon</a></li>
                                    <li><a href="widget.html">widget</a></li>
                                </ul>
                            </li>
                            <li><a href="contactus.html">contact us</a></li>
                        </ul>
                    </div>
                    <!--DL Menu END-->
                </div>
                <!--Navigation Wrap End-->
            </div>
            <!--Logo Bar End-->
        </div>
    </header>