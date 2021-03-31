<?php $stats_array = array_keys( $consecutive_matches_data[0]->matches_data ); ?>
<div class="consecutive-matches">
    <div class="table-filters">
        <span>Filter by:</span>
        <ul>
            <li>
                Team: 
                <select class="consecutive-matches-filter team-filter"> 
                    <option value="all"><?php _e( 'All', 'crb' ); ?></option>
                    <?php foreach ( $consecutive_matches_data as $count => $team ) : ?>
                        <option value="team-<?php echo $team->ID; ?>"><?php echo $team->team; ?></option>
                    <?php endforeach; ?>
                </select>
            </li>
            <li>
                Type:
                 <select class="consecutive-matches-filter type-filter"> 
                    <option value="all"><?php _e( 'All', 'crb' ); ?></option>
                    <?php foreach ( $stats_array as $type ) : ?>
                        <option value="<?php echo sanitize_title( $type ); ?>"><?php echo $type ?></option>
                    <?php endforeach ?>
                </select>
            </li>
        </ul>
    </div>
   
    <table>
        <tr>
            <th></th>
            <?php foreach ( $consecutive_matches_data as $count => $team ) : ?>
                <th class="table-team team-<?php echo $team->ID; ?>"><?php echo $team->team; ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ( $stats_array as $count => $statistic_key ) : ?>

            <tr class="table-type <?php echo sanitize_title( $statistic_key ); ?>">
                <th><?php echo $statistic_key; ?></th>
                <?php foreach ( $consecutive_matches_data as $team_count => $team ) : ?>
                    <td class="table-team team-<?php echo $team->ID; ?>">
                        <?php echo $team->matches_data[$statistic_key]; ?>
                    </td>
                <?php endforeach; ?>
            </tr>

        <?php endforeach; ?>
    </table>
</div>  