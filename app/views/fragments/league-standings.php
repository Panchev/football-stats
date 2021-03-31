<div class="kf_border">
    <ul class="kf_table league-standings">                            
        <li class="table_head">
            <div class="table_no">
                <strong><?php _e( 'Position', 'crb' ); ?></strong>
            </div>
            <div class="team_name">
                <strong><?php _e( 'Team', 'crb' ); ?></strong>
            </div>
            <div class="matches_played">
                <strong title="<?php _e( 'Games Played', 'crb' ); ?>">GP</strong>
            </div>

            <?php if ( $standings_type === 'corners' ) : ?>

                <div class="total_corners">
                    <strong><?php _e( 'Total Corners', 'crb' ); ?></strong>
                </div>
                <div class="corners_per_match">
                    <strong><?php _e( 'Corners Per Match', 'crb' ); ?></strong>
                </div>

            <?php elseif ( $standings_type === 'cards' ) : ?>

                <div class="yellow_cards">
                    <strong><?php _e( 'Yellow Cards', 'crb' ); ?></strong>
                </div>
                <div class="red_cards">
                    <strong><?php _e( 'Red Cards', 'crb' ); ?></strong>
                </div>

                <div class="total_cards">
                    <strong><?php _e( 'Total', 'crb' ); ?></strong>
                </div>

                 <div class="cards_per_match">
                    <strong><?php _e( 'Cards Per Match', 'crb' ); ?></strong>
                </div>
                
            <?php else : ?>

                <div class="match_win">
                    <strong title="<?php _e( 'Games Won', 'crb' ); ?>">w</strong>
                </div>
                <div class="match_draw">
                    <strong title="<?php _e( 'Draws', 'crb' ); ?>">d</strong>
                </div>
                <div class="match_loss">
                    <strong title="<?php _e( 'Games Lost', 'crb' ); ?>">l</strong>
                </div>
                <div>
                    <strong title=<?php _e( 'Goals Scored', 'crb' ); ?>>GS</strong>
                </div>
                <div>
                    <strong title=<?php _e( 'Goals Conceded', 'crb' ); ?>>GC</strong>
                </div>
                <div>
                    <strong title=<?php _e( 'Goal Difference', 'crb' ); ?>>GD</strong>
                </div>
                <div>
                    <strong title=<?php _e( 'Latest 5 games', 'crb' ); ?>>Form</strong>
                </div>
                <div class="team_points">
                    <strong><?php _e( 'Points', 'crb' ); ?></strong>
                </div>

            <?php endif; ?>
        </li>
        <?php foreach ( $standings as $count => $team ) : ?>
            <li>
                <div class="table_no">
                    <span><?php echo $count+1; ?></span>
                </div>
                <div class="team_name">                                                
                    <a href="<?php echo get_permalink( $team['id'] ); ?>"><?php echo $team['name']; ?></a>
                </div>
                <div class="matches_played">
                    <span><?php echo $team['number']; ?></strong>
                </div>

                <?php if ( $standings_type === 'corners' ) : ?>

                    <div class="total_corners">
                        <strong><?php echo $team['total_corners'] ?></strong>
                    </div>
                    <div class="corners_per_match">
                        <strong><?php echo $team['corners_per_match'] ?></strong>
                    </div>

                <?php elseif ( $standings_type === 'cards' ) : ?>

                    <div class="yellow_cards">
                        <strong><?php echo $team['yellow_cards'] ?></strong>
                    </div>
                    <div class="red_cards">
                        <strong><?php echo $team['red_cards'] ?></strong>
                    </div>

                    <div class="total_cards">
                        <strong><?php echo $team['total_cards'] ?></strong>
                    </div>

                     <div class="cards_per_match">
                        <strong><?php echo $team['cards_per_match'] ?></strong>
                    </div>
                    
                <?php else : ?>
                    <div class="match_win">
                        <span><?php echo $team['wins']; ?></span>
                    </div>
                     <div class="match_draw">
                        <span><?php echo $team['draws']; ?></span>
                    </div>
                    <div class="match_loss">
                        <span><?php echo $team['losses']; ?></span>
                    </div>

                    <div>
                        <span><?php echo $team['scored_goals']; ?></span>
                    </div>

                    <div>
                        <span><?php echo $team['conceded_goals']; ?></span>
                    </div>

                    <div>
                        <span><?php echo $team['goal_difference']; ?></span>
                    </div>

                    <div>
                        <span><?php echo $team['form']; ?></span>
                    </div>

                    <div class="team_point">
                        <span><?php echo $team['points']; ?></span>
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <!--Table Wrap End-->
</div>
