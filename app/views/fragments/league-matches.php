<div class="kf_border league-matches-container">
    <div class="matches-list">
        <h4><?php echo isset( $round ) ? ' Round ' . $round : 'Latest matches'; ?></h4>
        <ul>
            <?php foreach ( $matches as $match ) : ?>
                <li>
                    <span><?php echo $match['home_team_name']; ?></span>
                    <?php if ( $match['status'] === 'FT' ) : ?>
                        <span><?php echo $match['match_score']; ?></span>
                    <?php else : ?>
                        <span>? - ? </span>
                    <?php endif; ?>
                    <span><?php echo $match['away_team_name']; ?></span>
                    <span><?php echo $match['date']; ?></span>

                    <a href="<?php echo $match['match_link'] ?>" >Match Info</a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>