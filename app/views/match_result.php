<?php
get_header();
the_post(); 
?>
<div class="innner_banner">
    <div class="container">
        <h3>latest result</h3>
        <ul class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active"><span>latest result</span></li>
        </ul>
    </div>
</div>
<!--Inner Banner End-->
<div class="kode_content_wrap">
    <section class="latst_result_page">
        <div class="container">
            <div class="col-md-8">

                <div class="kf_overview kf_current_match_wrap">
                    <!--Heading 1 Start-->
                    <h6 class="kf_hd1 margin_0">
                        <span><?php _e( 'Match Stats', 'crb' ); ?></span>
                    </h6>
                    <!--Heading 1 End-->
                    <!--Kf Opponents Outer Start-->
                    <div class="kf_opponents_outerwrap">
                        <h6 class="kf_h4">
                            <span><?php echo $match_data['date']; ?></span>
                        </h6>
                        <!--Kf Opponents Start-->
                        <div class="kf_opponents_wrap">
                            <div class="kf_opponents_dec">
                                <div class="text">
                                    <h6>
                                        <a href="<?php echo get_permalink( $match_data['home_team_id'] ); ?>">
                                            <?php echo $match_data['home_team_name']; ?>
                                        </a>
                                    </h6>
                                </div>
                            </div>
                            <div class="kf_opponents_gols">
                                <?php if ( $match_data['status'] === 'NS' ) : ?>
                                    <h3>? : ?</h3>
                                    <h6><?php _e( 'Not Started', 'crb' ); ?></h6>
                                <?php else : ?>

                                    <h3><?php echo $match_data['match_score']; ?></h3>
                                    <h4>HT ( <?php echo $match_data['match_ht_score']; ?> )</h4>

                                <?php endif; ?>
                            </div>
                            <div class="kf_opponents_dec">
                                <div class="text">
                                    <h6>
                                        <a href="<?php echo get_permalink( $match_data['away_team_id'] ); ?>">
                                            <?php echo $match_data['away_team_name']; ?>
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        
                        <?php if ( $match_data['status'] === 'FT' ) : ?>
                            <div class="kf_scorecard">
                                <h4><?php _e( 'Match Stats', 'crb' ); ?></h4>   
                                <ul class="kf_table2">
                                    <li>
                                        <div class="table_info">
                                        </div>
                                        <div class="table_info">
                                            <span><b>Goals</b></span>
                                        </div>
                                        <div class="table_info">
                                            <span><b>Corners</b></span>
                                        </div>
                                        <div class="table_info">
                                            <span><b>Cards</b></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="table_info">
                                            <span><b><?php echo $match_data['home_team_name']; ?> </b></span>
                                        </div>
                                        <div class="table_info">
                                            <span><?php echo $match_data['home_team_goals']; ?></span>
                                        </div>
                                        <div class="table_info">
                                            <span><?php echo $match_data['home_corners']; ?></span>
                                        </div>
                                        <div class="table_info">
                                            <span><?php echo $match_data['home_team_cards']; ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="table_info">
                                            <span><b><?php echo $match_data['away_team_name']; ?> </b></span>
                                        </div>
                                        <div class="table_info">
                                            <span><?php echo $match_data['away_team_goals']; ?></span>
                                        </div>
                                        <div class="table_info">
                                            <span><?php echo $match_data['away_corners']; ?></span>
                                        </div>
                                        <div class="table_info">
                                            <span><?php echo $match_data['away_team_cards']; ?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="table_info">
                                            <span><b><?php _e( 'Total', 'crb' ); ?></b></span>
                                        </div>
                                        <div class="table_info">
                                            <span><?php echo $match_data['home_team_goals'] + $match_data['away_team_goals'] ?></span>
                                        </div>
                                        <div class="table_info">
                                            <span><?php echo $match_data['corners']; ?></span>
                                        </div>
                                        <div class="table_info">
                                            <span><?php echo $match_data['cards']; ?></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>            
            
            <aside class="col-md-4">
                <div class="widget widget_ranking widget_league_table">
                    <h6 class="kf_hd1">
                        <span><?php _e( 'Standings', 'crb' ); ?></span>
                    </h6>
                    <div class="kf_border">
                        <!--Table Wrap Start-->
                        <ul class="kf_table">                            
                            <li class="table_head">
                                <div class="team_name">
                                    <strong><?php _e( 'Team', 'crb' ); ?></strong>
                                </div>
                                <div class="team_logo">
                                </div>
                                <div class="match_win">
                                    <strong>w</strong>
                                </div>
                                <div class="match_draw">
                                    <strong>d</strong>
                                </div>
                                <div class="match_loss">
                                    <strong>l</strong>
                                </div>
                                <div class="team_points">
                                    <strong><?php _e( 'Points', 'crb' ); ?></strong>
                                </div>
                            </li>
                            <?php foreach ( $standings as $count => $team ) : 

                                $class = '';
                                if ( $team['id'] == $match_data['home_team_id'] || $team['id'] === $match_data['away_team_id'] ) {
                                    $class = 'class="active"';
                                } ?>
                                <li <?php echo $class; ?>>
                                    <div class="table_no">
                                        <span><?php echo $count+1; ?></span>
                                    </div>
                                    <div class="team_logo">
                                        <!-- <span><img src="images/team_logo.png" alt=""></span> -->                                        
                                        <a href="<?php echo get_permalink( $team['id'] ); ?>"><?php echo $team['name']; ?></a>
                                    </div>
                                    <div class="match_win">
                                        <span><?php echo $team['wins']; ?></span>
                                    </div>
                                     <div class="match_draw">
                                        <span><?php echo $team['draws']; ?></span>
                                    </div>
                                    <div class="match_loss">
                                        <span><?php echo $team['losses']; ?></span>
                                    </div>
                                    <div class="team_point">
                                        <span><?php echo $team['points']; ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                        <!--Table Wrap End-->
                    </div>
                </div>
            </aside>
        </div>
    </section>
</div>
<?php get_footer(); ?>