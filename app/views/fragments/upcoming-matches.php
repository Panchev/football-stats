<div class="widget">
    <h6 class="kf_hd1 margin_0">
        <span><?php _e( 'Upcoming Matches', 'crb' ); ?></span>
        <div class="league-upcoming-matches">
            <?php foreach ( $upcoming_matches as $date => $matches ) : ?>

                <p class="date"><?php echo date( 'd, F', strtotime( $date ) ); ?></p>
                <ul>
                    <?php foreach ( $matches as $match ) : ?>

                        <li>
                            <a class="home-team" href="<?php echo $match['home_team_link'] ?>">
                                <?php echo $match['home_team_name'] ?>
                            </a>
                            <em>-</em>
                            <a class="away-team" href="<?php echo $match['away_team_link'] ?>">
                                <?php echo $match['away_team_name'] ?>
                            </a> 
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
    </h6>
</div>