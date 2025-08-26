<?php header('Content-type: text/xml');?><?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url>
		<loc><?php echo RIZ_FULL_URL;?></loc>
		<priority>1.0</priority>
	</url>
	<?php foreach($data as $url) { ?>
	<url>
		<loc><?= $url ?></loc>
		<priority>0.5</priority>
	</url>
	<?php } ?>
</urlset>