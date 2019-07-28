<?php 
	/*Header for displaying longform written pieces, includes table of contents*/
?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
	<?php wp_head(); ?>
</head>
<body <?php body_class() ?>>
<?php wp_body_open() ?>
	<header class='large-screen-header longform-header'>
		<?php
		if (has_nav_menu('primary')) : ?>
			<nav class="main-navigation">
				<?php 
				wp_nav_menu(
					array(
						'theme_location'=>'primary',
						'menu_class'=>'primary-nav'
					)
				);
				?>
			</nav>
		<?php endif; 
		
		/*8Add navigation/table of contents functionality to sidebar*/
		//allows users to easily jump between sections of article

		//function to find the text of the headings in the article
		/*function findHeadings( $text ){
			
			$headings=array();

			$headingTypes = array('2','3','4','5','6');

			function matchTags( $str ){
				preg_match_all( $str, $text, $matches );
				foreach ( $matches[0] as $match ){
					$val=preg_replace('/<\/?h\d>/','',$match);
					array_push($headings,$val);
				}
			}

			foreach( $headingTypes as $headingType ){
				matchTags( '/<h'.$headingType.'>[\w\s\d]+<\/h'.$headingType.'>/' );
			}

			return $headings;
		}*/

		function truncateString( $newBeginning, $str){
				$index = strpos( $str, $newBeginning);
				$indexToTruncateAt = $index+4;
				$newString= substr( $str, $indexToTruncateAt);
				return $newString;
			}

		function traverse( $lvl, $text, $arr){

			preg_match('/<h\d>/', $text, $matches);

			$tagName = $matches[0]; 

			if (!$matches[0]){
				return $arr;
			}

			$headingType = substr($tagName,2,1); 

			$intHeadingType = (int)$headingType;

			if ( $intHeadingType === $lvl){

				array_push( $arr, $tagName);
				
				$remainder = truncateString( $tagName, $text);

				return traverse( $lvl, $remainder, $arr);
				
			
			} else if ( $intHeadingType > $lvl) {
				
				$subheadings = array();

				array_push( $subheadings, $tagName);
				
				array_push( $arr, $subheadings);

				$remainder = truncateString( $tagName, $text);

				return traverse( $lvl+1, $remainder, $arr);
			} else {
				return traverse( $lvl-1, $text, $arr);
			}
		}

		//print_r(traverse(2,'aa2aaa3aaa2a',array()));


		function printNav($headings){
			$nav = '';
			foreach ( $headings as $heading ){
				if ( gettype($heading)==="string" ){
					$nav.='<li><a href="'.'#'.str_replace(' ','_',$heading).'">'.$heading.'</a>';
				} else {
					$sublist = '<ul class="sublist">';
					$lis = printNav($heading);
					$sublist.=$lis;
					$sublist.='</ul>';
					$nav.=$sublist;
					$nav.='</li>';
				}
			}
			return $nav;
		}
		echo '<ul class="table-of-contents">';
		print_r(printNav( array('helicopter',array('catan'),'bed')));
		echo '</ul>';

		//start with h2s
		//if is h2, print it.
		//else, if h3, call function
		//when done with h3s, return array


		//We're querying the page content twice, 
			//first in this header to build this table of contents
			//then in regular loop to display the content
			//This is our first query
		$args = array(
			'pagename'=>($wp->query_vars['pagename'])
		);

		$query = new WP_Query( $args );


		//loop through the post (there should only be one since this is a page template)
		if ($query->have_posts()){
			while ($query->have_posts()){
				$query->the_post();

				//get the content
				$content = get_the_content();
		
				//retrieve the text of the h2s in the content as an array
				//$headings=findHeadings( '/<h2>[\w\s\d]+<\/h2>/', $content);
		?>
		<ul class="table-of-contents">
				<!--use the headings array to build a ul with list items that serve as the table of contents -->
				

				<li><a href="<?php echo '#'.str_replace(' ','_',$heading) ?>"><?php echo $heading; ?></a></li>
			
			
				<?php
				

				
			} 
		} 
			//reset postdata after the query.
			wp_reset_postdata();
			?>
		</ul>
	</header>