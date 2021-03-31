<?php 
get_header();
the_post();
$team = new Team( get_the_ID()) ;

$league = new League( $team->league_id );
$league_standings = $league->get_league_standings();

$team_upcoming_fixtures = $team->get_team_fixtures( false );
$team_past_fixtures     = $team->get_team_fixtures( true );
?>
    <div class="kode_content_wrap">
        <section class="kf_overview_page">
            <div class="container">
                <div class="overview_wrap">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="kf_overview kf_current_match_wrap">
                                <!--Heading 1 Start-->
                                <h6 class="kf_hd1 margin_0">
                                    <span>Last game result</span>
                                    <a class="prv_btn" href="#">Check Previous Result</a>
                                </h6>
                                <!--Heading 1 End-->
                                <!--Kf Opponents Outer Start-->
                                <div class="kf_opponents_outerwrap">
                                    <h6 class="kf_h4">
                                        <span>Championship quarter final</span>
                                        <em>Thursday, March 24th 205</em>
                                    </h6>
                                    <!--Kf Opponents Start-->
                                    <div class="kf_opponents_wrap">
                                        <div class="kf_opponents_dec">
                                            <span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/resources/images/cmt_1.png" alt=""></span>
                                            <div class="text">
                                                <h6><a href="#">Manchester united</a></h6>
                                                <p>ElR bros school</p>
                                            </div>
                                        </div>
                                        <div class="kf_opponents_gols">
                                            <h5><span>107</span><span>-102</span></h5>
                                            <p>Final score</p>
                                        </div>
                                        <div class="kf_opponents_dec span_right">
                                            <span><img src="<?php echo bloginfo('stylesheet_directory'); ?>/resources/images/cmt_2.png" alt=""></span>
                                            <div class="text">
                                                <h6><a href="#">Yamaha fc jubilo</a></h6>
                                                <p>ElR bros school</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Kf Opponents End-->
                                    <!--Kf Score Card Start-->
                                    <div class="kf_scorecard">
                                        <div class="kf_progress_wrap">
                                            <div class="kf_progress">
                                                <span class="progress_label">ass</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100" style="width: 36%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">36</span>
                                            </div>
                                            <div class="kf_progress">
                                                <span class="progress_label">reb</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100" style="width: 18%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">18</span>
                                            </div>
                                            <div class="kf_progress">
                                                <span class="progress_label">ste</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100" style="width: 24%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">24</span>
                                            </div>
                                            <div class="kf_progress">
                                                <span class="progress_label">blk</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 32%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">23</span>
                                            </div>
                                            <div class="kf_progress">
                                                <span class="progress_label">fou</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">14</span>
                                            </div>
                                        </div>
                                        <ul class="kf_table2">
                                            <li>
                                                <div class="table_info">
                                                    <span><b>Scoreboard</b></span>
                                                </div>
                                                <div class="table_info">
                                                    <span><b>1</b></span>
                                                </div>
                                                <div class="table_info">
                                                    <span><b>2</b></span>
                                                </div>
                                                <div class="table_info">
                                                    <span><b>3</b></span>
                                                </div>
                                                <div class="table_info">
                                                    <span><b>4</b></span>
                                                </div>
                                                <div class="table_info">
                                                    <span><b>t</b></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="table_info">
                                                    <span><b>Manchester </b></span>
                                                </div>
                                                <div class="table_info">
                                                    <span>30</span>
                                                </div>
                                                <div class="table_info">
                                                    <span>31</span>
                                                </div>
                                                <div class="table_info">
                                                    <span>22</span>
                                                </div>
                                                <div class="table_info">
                                                    <span>24</span>
                                                </div>
                                                <div class="table_info">
                                                    <span><b>107</b></span>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="table_info">
                                                    <span><b>Manchester </b></span>
                                                </div>
                                                <div class="table_info">
                                                    <span>22</span>
                                                </div>
                                                <div class="table_info">
                                                    <span>34</span>
                                                </div>
                                                <div class="table_info">
                                                    <span>20</span>
                                                </div>
                                                <div class="table_info">
                                                    <span>26</span>
                                                </div>
                                                <div class="table_info">
                                                    <span><b>102</b></span>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="kf_progress_wrap kf_progress_wrap2">
                                            <div class="kf_progress">
                                                <span class="progress_label">ass</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="36" aria-valuemin="0" aria-valuemax="100" style="width: 36%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">36</span>
                                            </div>
                                            <div class="kf_progress">
                                                <span class="progress_label">reb</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="18" aria-valuemin="0" aria-valuemax="100" style="width: 18%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">18</span>
                                            </div>
                                            <div class="kf_progress">
                                                <span class="progress_label">ste</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100" style="width: 24%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">24</span>
                                            </div>
                                            <div class="kf_progress">
                                                <span class="progress_label">blk</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 32%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">23</span>
                                            </div>
                                            <div class="kf_progress">
                                                <span class="progress_label">fou</span>
                                                <div class="progress">
                                                  <div class="progress-bar" role="progressbar" aria-valuenow="23" aria-valuemin="0" aria-valuemax="100" style="width: 23%;">
                                                  </div>
                                                </div>
                                                <span class="progress_precent">14</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--Kf Score Card End-->
                                </div>
                                <!--Kf Opponents Outer End-->
                            </div>                        
                        </div>
                        <aside class="col-md-8">
                            <!--Widget League Table Start-->
                            <div class="widget widget_ranking widget_league_table">
                                <!--Heading 1 Start-->
                                <h6 class="kf_hd1">
                                    <span>Playoff standings</span>
                                </h6>
                                <!--Heading 1 END-->
                                <div class="kf_border">
                                    <!--Table Wrap Start-->
                                    <ul class="kf_table">
                                        <li class="table_head">
                                            <div class="team_position">
                                                <strong>Position</strong>
                                            </div>
                                            <div class="team_name"><strong>Team</strong></div>
                                            <div class="points"><strong>P</strong></div>
                                            <div class="wins"><strong>W</strong></div>
                                            <div class="draws"><strong>D</strong></div>
                                            <div class="losses"><strong>L</strong></div>
                                            <div class="goals-scored"><strong>GS</strong></div>
                                            <div class="goals-conceded"><strong>GA</strong></div>
                                            <div class="goal-difference"><strong>GD</strong></div>
                                        </li>
                                        <?php foreach ( $league_standings as $count => $team ) : ?>
                                            <li>
                                                <div class="table_no">
                                                    <span><?php echo $count+1; ?></span>
                                                </div>
                                                <div class="team_name">
                                                    <a href="#"><?php echo $team['name']; ?></a>
                                                </div>
                                                <div class="points"><?php echo $team['points']; ?></div>
                                                <div class="wins"><?php echo $team['wins']; ?></div>
                                                <div class="draws"><?php echo $team['draws']; ?></div>
                                                <div class="losses"><?php echo $team['losses']; ?></div>
                                                <div class="goals-scored"><?php echo $team['scored_goals']; ?></div>
                                                <div class="goals-conceded"><?php echo $team['conceded_goals']; ?></div>
                                                <div class="goal-difference"><?php echo $team['goal_difference']; ?></div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                    <!--Table Wrap End-->
                                </div>
                            </div>                                   
                        </aside>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php get_footer(); 