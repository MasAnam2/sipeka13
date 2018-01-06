<script>
	var colors          = ['lime', 'green', 'emerald', 'teal', 'blue', 'cyan', 'cobalt', 'indigo', 'violet', 'pink', 'magenta', 'crimson', 'red', 'orange', 'amber', 'yellow', 'brown', 'olive', 'steel', 'mauve', 'taupe', 'darkBrown', 'darkCrimson', 'darkMagenta', 'darkIndigo', 'darkCyan', 'darkCobalt', 'darkTeal', 'darkEmerald', 'darkGreen', 'darkOrange', 'darkRed', 'darkPink', 'darkViolet', 'darkBlue', 'lightBlue', 'lightRed', 'lightGreen', 'lighterBlue', 'lightOlive', 'lightPink'];

	function get_random_color(){
		return colors[random(0, colors.length)];
	}

	$('[data-role="tile"]').each(function(){
		var tile = $(this);
		tile.addClass('bg-'+get_random_color()+' fg-white');
	});
</script>