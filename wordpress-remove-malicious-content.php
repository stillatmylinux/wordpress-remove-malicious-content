<?php

include_once 'wp-load.php';

$output = '';

if( isset( $_POST['malicious_code']) && !empty( $_POST['malicious_code'] ) ) {
	$sql = $wpdb->prepare( "UPDATE wp_posts SET post_content = REPLACE(post_content, %s, '') WHERE post_content LIKE %s;", $_POST['malicious_code'], '%' . $_POST['malicious_code'] . '%' );
	$sql = str_replace('\\\\\\', '\\', $sql);
	$output = $wpdb->query( $sql );
}

?><html>
<head>
	<title>Replace Hacked Content Tool</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>
<body>
	<h1>Replace MySQL string</h1>

	<textarea name="output"><?php echo $output; ?></textarea>
	<form action="mysql-replace-content.php" method="post">
		<textarea name="malicious_code" id="malicious_code" rows="20" cols="100"></textarea><br>
		<hr>
		<input type="submit" class="btn" name="submit" value="Remove" />
	</form>
	<script type="text/javascript">
		/*
		jQuery('.btn').on('click', function() {
			var text = jQuery('#malicious_code').val();
			text = text.replace(/'/g, "\\\'");
			mysql = 'UPDATE wp_posts SET post_content = REPLACE(post_content, \'';
			mysql += text;
			mysql += '\', \'\') WHERE post_content LIKE \'%';
			mysql += text;
			mysql += '%\';';
			jQuery('#output').val( mysql );
		});
		*/
	</script>
		</body>
</html>
