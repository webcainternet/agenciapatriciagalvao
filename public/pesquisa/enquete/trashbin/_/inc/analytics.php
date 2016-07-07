<?php
    //Code can go here to set the $VirtualPageView if necessary
?>
<script>
    var _gaq = [];
    var _gaq=[['_setAccount','UA-48870751-1']];
    _gaq.push(['_trackPageview'<?php if ($VirtualPageView != '') echo(", '" . $VirtualPageView . "'"); ?>]);
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src='//www.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
</script>
