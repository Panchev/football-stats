<?php
get_header();
the_post();
?>
    <div class="kode_content_wrap">
        <section>
            <div class="container">
                <?php foreach ( $leagues as $league ) : ?>
                    <div class="col-md-4 league-box">
                        <h5 class="kf_hd1">
                            <span><?php echo $league->name; ?></span>
                        </h5>
                        
                        <div class="league-content">
                            <?php if ( $league->upcoming_matches ) : ?>
                                <div class="league-matches">                                
                                    <span><?php _e( 'Upcoming Matches' ); ?></span>
                                    <ul>
                                        <?php 
                                        $latest_match_date = $league->upcoming_matches[0]['date'];
                                        foreach ( $league->upcoming_matches as $count => $match ) : 

                                            $match_class = '';
                                            if ( $count > 5 ) {
                                                $match_class = 'hidden';
                                            } 

                                            if ( $latest_match_date !== $match['date'] ) {
                                                $match_class .= ' new-date';
                                                $latest_match_date = $match['date'];
                                            } ?>

                                            <li class="<?php echo $match_class; ?>">
                                                <span><?php echo $match['home_team_name'] . ' - ' . $match['away_team_name']; ?></span>
                                                <span class="match-date"><?php echo $match['date']; ?></span>
                                            </li>

                                            <?php if ( $count == 5 ) : ?>
                                                <li class="show-more">
                                                    <a><?php _e( 'Show more', 'crb' ); ?></a>
                                                </li>
                                            <?php endif; ?>


                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; 

                            if ( $league->upcoming_matches ) : ?>
                                <div class="league-matches">
                                    <span><?php _e( 'Latest Results' ); ?></span>
                                    <ul>
                                        <?php 
                                        $latest_match_date = $league->latest_matches[0]['date'];
                                        foreach ( $league->latest_matches as $count => $match ) : 

                                            $match_class = '';
                                            if ( $count > 5 ) {
                                                $match_class = 'hidden';
                                            } 
                                            
                                            if ( $latest_match_date !== $match['date'] ) {
                                                $match_class .= ' new-date';
                                                $latest_match_date = $match['date'];
                                            }?>

                                            <li class="<?php echo $match_class; ?>">
                                                <span>
                                                    <?php echo $match['home_team_name'] . ' <strong>' . $match['match_score'] . '</strong> ' . $match['away_team_name']; ?>
                                                </span>
                                                <span class="match-date"><?php echo $match['date']; ?></span>
                                            </li>

                                            <?php if ( $count == 5 ) : ?>
                                                <li class="show-more">
                                                    <a><?php _e( 'Show more', 'crb' ); ?></a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <a class="full-league-info" href="<?php echo get_term_link( $league->term_id, 'crb_league' ); ?>"><?php _e( 'Full League Info', 'crb' ); ?></a>  
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
<?php get_footer(); ?>