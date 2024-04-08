<script src="js/jquery.min.js"></script>
<script>
    function copyToClipboard(element) {
        $(element).select();
        document.execCommand("copy");
        $('#copied').html('Passcode copied to clipboard');
        $('#copied').fadeOut(2000);
        // cc.innerHTML();
    }
</script>
<?php

$random = time() . rand(10*45, 100*98);
$encoded= md5($random);
$passcode_trans= strtoupper($encoded);
$output=substr($passcode_trans, 0, 7);
// echo $output;

?>
<span id="copied"></span>
<input type="text" value="<?php echo $output;?>" id="link" class="span12" />
<button type="button" class="btn btn-info btn-sm" onclick="copyToClipboard('#link')">
    Copy Input Value
</button>


