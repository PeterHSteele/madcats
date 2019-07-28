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
		
		/*Add navigation/table of contents functionality to sidebar*/
		//allows users to easily jump between sections of article

		/*
		for use in findHeadings, strips everything through the next <h*></h*> tag 
		from the beginning of an html string
		*/
		function truncateString( $newBeginning, $str, $lengthOfHeading){
				$index = strpos( $str, $newBeginning);
				$indexToTruncateAt = $index+$lengthOfHeading;
				$newString= substr( $str, $indexToTruncateAt);
				return $newString;
			}

		function findHeadings( $lvl, $text, $arr){
		/*
		function to find the text of the headings in the article and return them as multi-level array,
		with the h2s in outermost layer, h3s one level down, etc.

		e.g.,

		Array(
			[0] =>'first h2',
			[1] => Array( [0] => 'an h3', [1] => 'another h3' ),
			[2] =>'second h2'
		)

		Params:
		$lvl = (int) type of heading to look for (ie, 2 = <h2>)
		$text = (string) html content to search
		$arr = (array) list of all the headings and arrays of subheadings found so far 
							->search progresses from beginning of content to end
							->pass an empty array to original call

		*/
			
			preg_match('/<h\d>[\w\s\d]+<\/h\d>/', $text, $matches);

			if (!$matches[0]){
				return $arr;
			}

			$headingWithTags = $matches[0];

			$tagName = substr($matches[0],0,4); 

			$headingLengthWithTags = strlen($headingWithTags);

			$headingLength = strlen($matches[0])-9;//'-9' because 9 of the characters are part of <h*> tags. we only want the text

			$heading = substr($matches[0],4,$headingLength);

			$headingType = substr($tagName,2,1); 

			$intHeadingType = (int)$headingType;

			if ( $intHeadingType === $lvl){

				array_push( $arr, $heading);
				
				$remainder = truncateString( $tagName, $text, $headingLengthWithTags);

				return findHeadings( $lvl, $remainder, $arr);
				
			
			} else if ( $intHeadingType > $lvl) {
				
				$subheadings = array();

				array_push( $subheadings, $heading);
				
				array_push( $arr, $subheadings);

				$remainder = truncateString( $tagName, $text, $headingLengthWithTags);

				return findHeadings( $lvl+1, $remainder, $arr);
			} else {
				return findHeadings( $lvl-1, $text, $arr);
			}
		}

		//print_r(strlen('<h2>bulls</h2>')-9);

		function printNav( $headings ){
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

		//traverse(2,'<h2>bulls</h2><h3>kings</h3><h2>wizards</h2>',array());

		//printNav(array('bulls',array('kings'),'wizards'));
		/*echo '<ul class="table-of-contents">';
		echo printNav(traverse(2,'<h2>bulls</h2><h3>kings</h3><h2>wizards</h2>',array()));
		echo '</ul>';*/

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
		
				//retrieve the text of the headings in the content as an array
				$headings=findHeadings(2,$content,array());
		?>
		<ul class="table-of-contents">
			<?php 
				//print table of contents from the headings array
				echo printNav($headings); 
			?>
		</ul>
		
		<?php 
			}
		}	
			//reset post data after the query
			wp_reset_postdata(); 
		?>
	</header>