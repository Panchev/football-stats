<?php
get_header();
the_post();

$current_league = get_queried_object();
$league_link    = get_term_link( $current_league->term_id, 'crb_league' );
?>
    <div class="kode_content_wrap">
        <section class="kf_overview_page">
            <div class="container">
                <div class="overview_wrap">
                    <?php
                    if ( isset( $consecutive_matches_data ) ) : ?>

                        <?php crb_render_fragment( 'consecutive-matches-table', [ 'consecutive_matches_data' => $consecutive_matches_data ]); ?>

                    <?php else : ?>

                        <div class="row">
                            <div class="col-md-8 wrapper">
                                <!-- <a href="#">matches</a> -->
                                <h6 class="kf_hd1">
                                    <span><?php echo $current_screen; ?></span>


                                    <?php if ( isset( $standings ) ) : ?>

                                        <ul class="league-subnavigation">
                                            <li><a href="<?php echo $league_link; ?>"><?php _e( 'Overall', 'crb' ); ?></a></li>
                                            <li><a href="<?php echo $league_link; ?>standings/home"><?php _e( 'Home', 'crb' ); ?></a></li>
                                            <li><a href="<?php echo $league_link; ?>standings/away"><?php _e( 'Away', 'crb' ); ?></a></li>
                                            <li><a href="<?php echo $league_link; ?>standings/corners"><?php _e( 'Corners', 'crb' ); ?></a></li>
                                            <li><a href="<?php echo $league_link; ?>standings/cards"><?php _e( 'Cards', 'crb' ); ?></a></li>
                                        </ul>

                                        <!--<ul class="orderby-subnavigation">
                                            <?php
                                            $orderby_options = [
                                                'wins' => __( 'Wins', 'crb' ),
                                                'draws' => __( 'Draws', 'crb' ),
                                                'losses' => __( 'Losses', 'crb' ),
                                            ];
                                            foreach ( $orderby_options as $option => $label ) : ?>
                                                <li>
                                                    <a href="<?php echo $league_link ?>standings/<?php echo $option; ?>"><?php echo $label; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>-->

                                    <?php endif; ?>


                                    <?php if ( isset( $matches ) ) : ?>

                                        <div class="league-subnavigation">
                                            <a href="#"><?php _e( 'Latest Matches', 'crb' ); ?></a>
                                            <p>
                                                <em><?php _e( 'Show matches by round', 'crb' ) ?></em>
                                                <select class="league-rounds-menu">
                                                    <option value=""><?php _e( 'Round', 'crb' ); ?></option>
                                                    <?php foreach ( $league_rounds as $round ) : ?>
                                                        <option value="<?php echo $round; ?>"><?php echo $round ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </p>
                                        </div>

                                    <?php endif; ?>
                                </h6>
                                <?php if ( isset( $standings ) ) : ?>

                                    <?php crb_render_fragment( 'league-standings', [ 'standings' => $standings, 'standings_type' => $standings_type ] ); ?>

                                <?php elseif ( isset( $matches ) ) : ?>
                                    <?php crb_render_fragment( 'league-matches', [ 'matches' => $matches ] ); ?>
                                <?php endif; ?>
                            </div>

                        </div>

                    <?php endif; ?>
                </div>
            </div>
        </section>
    </div>
<?php get_footer();
