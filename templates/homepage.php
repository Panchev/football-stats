<?php
namespace App\Controllers\Web;
/*
	Template Name: Homepage
*/
	get_header();
	the_post();
?>

    <!--Main Content Wrap Start-->
    <div class="kode_content_wrap">
        <?php if ( $upcoming_matches ) : ?>

        <!--Result Slider Start-->
            <div class="result_slide_wrap">
                <div class="result_slider">
                    <?php foreach ( $upcoming_matches as $match ) : 
                        $match_object = new MatchController();
                        $match_object->init( $match->ID );
                        $match_stats = $match_object->get_match_stats();
                        ?>
                        <div>
                            <div class="kf_result_thumb">
                                <span><?php echo $match_stats['date']; ?> <em>2:15 pm</em></span>
                                <div class="kf_result">
                                    <div class="figure pull-left">
                                        <a href="<?php echo get_permalink( $match_stats['home_team_id'] ); ?>"><?php echo $match_stats['home_team_name']; ?></a>
                                    </div>
                                    <span>vs</span>
                                    <div class="figure pull-right">
                                        <a href="<?php echo get_permalink( $match_stats['away_team_id'] ); ?>"><?php echo $match_stats['away_team_name']; ?></a>
                                    </div>
                                </div>
                                <a href="<?php echo get_term_link( $match_object->league_id, 'crb_league' ) ?>"><?php echo $match_object->league_name; ?></a>
                            </div>    
                        </div>               
                    <?php endforeach; ?>
                </div>
            </div>

        <?php endif; ?>
        <!--Result Slider End-->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!--Featured Slider Start-->
                        <div class="kf_featured_slider">
                            <!--Heading 1 Start-->
                            <h6 class="kf_hd1">
                                <span>Featured News</span>
                            </h6>
                            <!--Heading 1 END-->
                            <div class="featured_slider">
                                <div>
                                    <div class="kf_featured_thumb">
                                        <figure>
                                            <img src="extra-<?php echo bloginfo('stylesheet_directory'); ?>/resources/images/feature_slider.jpg" alt="">
                                        </figure>
                                        <div class="text">
                                            <h6>Fifa world cup 2016</h6>                                
                                            <h2><a href="#">Germany vs Argentina</a></h2>
                                            <span>11 Sep, 2016 / Anna Smith</span>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="kf_featured_thumb">
                                        <figure>
                                            <img src="extra-<?php echo bloginfo('stylesheet_directory'); ?>/resources/images/feature_slider.jpg" alt="">
                                        </figure>
                                        <div class="text">
                                            <h6>Fifa world cup 2016</h6>                                
                                            <h2><a href="#">Germany vs Argentina</a></h2>
                                            <span>11 Sep, 2016 / Anna Smith</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <aside class="col-md-4">
                       
                        <!--Widget Next Match Start-->
                        <div class="widget widget_nextmatch">
                            <!--Heading 1 Start-->
                            <h6 class="kf_hd1">
                                <span>Next Match</span>
                            </h6>
                            <!--Heading 1 END-->
                            <div class="kf_border">
                                <!--Widget Next Match Dec Start-->
                                <div class="nextmatch_dec">
                                    <h6>Laliga Semi Finals at city stadium</h6>
                                    <span>Friday, 10th Sep, 2016, 16:00GMT</span>
                                    <div class="match_teams">
                                        <div class="pull-left">
                                            <a href="#"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/resources/images/team_logo11.png" alt=""></a>
                                        </div>
                                        <span>vs</span>
                                        <div class="pull-right">
                                            <a href="#"><img src="<?php echo bloginfo('stylesheet_directory'); ?>/resources/images/team_logo12.png" alt=""></a>
                                        </div>
                                    </div>
                                    <a class="input-btn" href="#">Buy Tickets Now</a>
                                    <h5>Starting in</h5>
                                    <!--Widget COUNT Down Start-->
                                    <ul class="kf_countdown countdown">
                                        <li>
                                            <span class="days">69</span>
                                            <p class="days_ref">days</p>
                                        </li>
                                        <li>
                                            <span class="hours">13</span>
                                            <p class="hours_ref">hours</p>
                                        </li>
                                        <li>
                                            <span class="minutes">44</span>
                                            <p class="minutes_ref">mins</p>
                                        </li>
                                        <li>
                                            <span class="seconds last">12</span>
                                            <p class="seconds_ref">secs</p>
                                        </li>
                                    </ul>
                                    <!--Widget COUNT Down End-->
                                </div>
                                <!--Widget Next Match Dec End-->
                            </div>
                        </div>
                        <!--Widget Next Match End-->
                    </aside>
                </div>
            </div>
        </section>
<?php get_footer(); ?>