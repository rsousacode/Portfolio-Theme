<?php
get_header();

$projects = json_encode(get_all_projects());
$author = get_option('rs_theme_options');

?>
<script src='https://unpkg.com/flipping@latest/dist/flipping.web.js'></script> <script>projects = <?php echo $projects?>;author = <?php echo json_encode($author)?>;</script><div id="home"></div>
<?php
get_footer();