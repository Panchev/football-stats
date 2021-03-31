<?php 
use MyTest\CrbClass;	
use App\Controllers\Web\LeagueController;

$league = new LeagueController();

echo '<pre>';
print_r($league);
echo '</pre>';

$test = new CrbClass();

echo '<pre>';
print_r($test);
echo '</pre>';

get_header(); 
$classes = get_declared_classes();
        echo '<pre>';
        print_r($classes);
        echo '</pre>';
        exit;?>

<div class="intro" style="background: #663290;">
	<div class="intro__content" style="padding: 20px; width: 100%;">
		<div class="intro__entry" style="width: 100%; text-align: center;">
			<div class="intro__head">
				<?php echo crb_the_title( '<h1 class="pagetitle">', '</h1>' ); ?>
			</div><!-- /.intro__head -->

			<?php printf( __( '<p>If you\'re having trouble locating a page, try the main menu above or visit the <a href="%1$s">home page</a>.</p>', 'crb' ), home_url( '/' ) ); ?>

		</div><!-- /.intro__entry -->
	</div><!-- /.intro__content -->
</div><!-- /.intro -->

<?php get_footer();
