<?php
get_header();
the_post();
?>
    <!--Inner Banner Start-->
    <div class="innner_banner">
        <div class="container">
            <h3><?php the_title(); ?></h3>
        </div>
    </div>
    <!--Inner Banner End-->
    <div class="kode_content_wrap">
        <section class="kf_overview_page">
            <div class="container">
                <div class="overview_wrap">
                    <div class="row">
                        <div class="col-md-8 wrapper">
                            <div class="kf_overview kf_overview_schedule">
                                <h6 class="kf_hd1 margin_0">
                                    <span>Fixtures</span>
                                </h6>
                                <ul class="kf_table2">
                                    <li class="table_head">
                                        <div class="tb2_date">
                                            <span>Date</span>
                                        </div>
                                        <div class="match">
                                            <span>Match result ( FT )</span>
                                        </div>
                                        <div class="tb2_ht">
                                            <span>HT</span>
                                        </div>
                                        <div class="tb2_corners">
                                            <span>Corners</span>
                                        </div>
                                        <div class="tb2_cards">
                                            <span>Cards</span>
                                        </div>
                                        <div class="tb2_over1_5">
                                            <span>1.5+</span>
                                        </div>
                                        <div class="tb2_over2_5">
                                            <span>2.5+</span>
                                        </div>
                                    </li>
                                    <?php foreach ( $fixtures as $fixture ) :

                                        $date = carbon_get_post_meta( $fixture->ID, 'crb_match_date' );
                                        $home_team_id = carbon_get_post_meta( $fixture->ID, 'crb_match_home_team' );
                                        $away_team_id = carbon_get_post_meta( $fixture->ID, 'crb_match_away_team' );
                                        $score        = carbon_get_post_meta( $fixture->ID, 'crb_match_score' );
                                        if ( $score == '' ) {
                                            $score = '? - ?';
                                        }
                                        $ht_score = carbon_get_post_meta( $fixture->ID, 'crb_match_ht_score' );

                                        $home_team_goals = carbon_get_post_meta( $fixture->ID, 'crb_match_home_goals' );
                                        $away_team_goals = carbon_get_post_meta( $fixture->ID, 'crb_match_away_goals' );

                                        $corners = carbon_get_post_meta( $fixture->ID, 'crb_match_corners' );
                                        $cards   = carbon_get_post_meta( $fixture->ID, 'crb_match_cards' );

                                        $is_current_team_home = $home_team_id == get_the_ID();

                                        if ( $score !== '? - ?' ) {
                                            if ( $home_team_goals == $away_team_goals ) {
                                                $fixture_result = 'draw';
                                            } elseif ( $is_current_team_home ) {
                                                if ( $home_team_goals > $away_team_goals ) {
                                                    $fixture_result = 'win';
                                                } else {
                                                    $fixture_result = 'loss';
                                                }
                                            } else {
                                                if ( $away_team_goals > $home_team_goals ) {
                                                    $fixture_result = 'win';
                                                } else {
                                                    $fixture_result = 'loss';
                                                }
                                            }
                                        } else {
                                            $fixture_result = 'not-started';
                                        }
                                        ?>
                                        <li class="<?php echo $fixture_result; ?>">
                                            <div class="tb2_date">
                                                <span><?php echo date( 'd M', strtotime($date) ); ?><!--Friday, March 16--></span>
                                            </div>
                                            <div class="versus">
                                                <div>
                                                    <p>
                                                        <?php
                                                        $home_team_class = 'home-team';
                                                        $away_team_class = 'away-team';
                                                        if ( $home_team_id === get_the_ID() ) {
                                                            $home_team_class .= ' current-team';
                                                        }

                                                        if ( $away_team_id === get_the_ID() ) {
                                                            $away_team_class .= ' current-team';
                                                        }
                                                        ?>
                                                        <a class="<?php echo $home_team_class; ?>" href="<?php echo get_permalink( $home_team_id ); ?>"><?php echo get_the_title( $home_team_id ); ?></a>
                                                        <span><?php echo $score ?></span>
                                                        <a class="<?php echo $away_team_class; ?>" href="<?php echo get_permalink( $away_team_id ); ?>"><?php echo get_the_title( $away_team_id ); ?></a>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="tb2_ht">
                                                <span><?php echo $ht_score; ?></span>
                                            </div>
                                            <div class="tb2_corners">
                                                <span><?php echo $corners; ?></span>
                                            </div>
                                            <div class="tb2_cards">
                                                <span><?php echo $cards; ?></span>
                                            </div>
                                            <div class="tb2_over1_5">
                                                <span>
                                                    <?php if (  $score !== '? - ?' && ( $home_team_goals + $away_team_goals ) > 1 ) {
                                                        echo '&#10003';
                                                    } ?>
                                                </span>
                                            </div>
                                            <div class="tb2_over2_5">
                                                <span>
                                                    <?php if (  $score !== '? - ?' && ( $home_team_goals + $away_team_goals ) > 2 ) {
                                                        echo '&#10003';
                                                    } ?>
                                                </span>
                                            </div>

                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <div class="row kf_overview kf_overview_schedule">
                                <div class="col-md-3 col-sm-3">
                                    <div class="text">
                                        <h2 class="counter"><?php echo $team_stats['points']['avg']; ?></h2>
                                        <span><?php _e( 'Points Per Game', 'crb' ); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="text">
                                        <h2 class="counter"><?php echo $team_stats['goals']['avg_scored_goals']; ?></h2>
                                        <span><?php _e( 'Scored Goals Per Game', 'crb' ); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="text">
                                        <h2 class="counter"><?php echo $team_stats['goals']['avg_conceded_goals']; ?></h2>
                                        <span><?php _e( 'Conceded Goals Per Game', 'crb' ); ?></span>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-3">
                                    <div class="text">
                                        <h2 class="counter"><?php echo $team_stats['goals']['avg_total_goals']; ?></h2>
                                        <span><?php _e( 'Total Goals Per Game', 'crb' ); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="team-series">
                                <h6 class="kf_hd1 margin_0">
                                    <span>Team series/streaks</span>
                                </h6>

                                <table>
                                    <tr>
                                        <th><?php _e( 'Type', 'crb' ); ?></th>
                                        <th><?php _e( 'Number of matches', 'crb' ); ?></th>
                                    </tr>

                                    <?php foreach ( $team_series as $label => $value ) : ?>

                                        <tr>
                                            <td><?php echo $label; ?></td>
                                            <td><?php echo $value ?></td>
                                        </tr>

                                    <?php endforeach;?>
                                </table>
                            </div>
                        </div>
                        <aside class="col-md-4 aside">
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
                                            if ( $team['id'] == get_the_ID() ) {
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

                            <div class="widget">
                                <h6 class="kf_hd1 margin_0">
                                    <span><?php _e( 'Team stats', 'crb' ); ?></span>
                                </h6>
                                <div class="team_stats">
                                    <div class="row">
                                        <?php $results = [ 'wins', 'draws', 'losses' ]; ?>
                                        <h6><?php _e( 'Results', 'crb' ); ?></h6>
                                        <table>
                                            <tr>
                                                <th>FT ( full time ) results</th>
                                                <th>Win</th>
                                                <th>Draw</th>
                                                <th>Lose</th>
                                            </tr>
                                            <?php foreach ( ['home', 'away', 'total'] as $location ) : ?>

                                                <tr>
                                                    <td><?php echo $location; ?></td>
                                                    <?php foreach ( $results as $result ) : ?>
                                                        <td><?php echo $team_stats['results'][$result][$location]; ?></td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>

                                            <tr>
                                                <th>HT ( half time ) results</th>
                                                <th>Win</th>
                                                <th>Draw</th>
                                                <th>Lose</th>
                                            </tr>
                                            <?php foreach ( ['home', 'away', 'total'] as $location ) : ?>

                                                <tr>
                                                    <td><?php echo $location; ?></td>
                                                    <?php foreach ( $results as $result ) : ?>
                                                        <td><?php echo $team_stats['results'][$result]['ht_' . $location]; ?></td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </table>

                                        <h6><?php _e( 'Cards', 'crb' ); ?></h6>
                                        <table>
                                            <tr>
                                                <th><?php _e( 'Yellow', 'crb' ); ?></th>
                                                <th><?php _e( 'Red', 'crb' ); ?></th>
                                                <th><?php _e( 'Total', 'crb' ); ?></th>
                                                <th><?php _e( 'Cards per match', 'crb' ); ?></th>
                                            </tr>
                                            <tr>
                                                <td><?php echo $team_stats['cards']['yellow'] ?></td>
                                                <td><?php echo $team_stats['cards']['red'];?></td>
                                                <td><?php echo $team_stats['cards']['total']; ?></td>
                                                <td><?php echo $team_stats['cards']['avg']; ?></td>
                                            </tr>
                                        </table>


                                        <h6><?php _e( 'Corners', 'crb' ); ?></h6>
                                        <table>
                                            <tr>
                                                <th><?php _e( 'Total', 'crb' ); ?></th>
                                                <th><?php _e( 'Corners per match', 'crb' ); ?></th>
                                            </tr>
                                            <tr>
                                                <td><?php echo $team_stats['corners']['total'] ?></td>
                                                <td><?php echo $team_stats['corners']['avg'];?></td>
                                            </tr>
                                        </table>

                                    </div>

                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php get_footer();
