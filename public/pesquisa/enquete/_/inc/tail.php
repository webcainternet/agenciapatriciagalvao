<script src="scripts/vendor.js"></script>

<script src="scripts/plugins.js"></script>

<?php
    $secret ="37VbrTCs67c18H1vxS69dWuDH4OHuG7f";

    $item = array(
      "time"=>time(),
      "token_id"=>"A125FC1134F884BB598B94C11D578"
    );

    $signed = base64_encode(hash_hmac("sha256",json_encode($item),$secret));
    $item = base64_encode(json_encode($item));

    $ajax_url = "_/lib/save_entry.php?signed=$signed&item=$item";
    $ajax_images_url = "_/lib/save_image.php?signed=$signed&item=$item";
?>
<script>
    var ajaxUrl = '<?php echo $ajax_url; ?>';
    var ajaxUrl2 = '<?php echo $ajax_images_url; ?>';
    var baseUrl = '<?php echo BASE_URL; ?>';
</script>

<script src="scripts/main.js"></script>
