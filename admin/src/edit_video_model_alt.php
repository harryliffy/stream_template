<?php
include('functions.php');

$pub_status = $_POST['pub_status'];
$pub_date = $_POST['broadcast_date'];
$video_title = $_POST['title'];
$video_category = $_POST['category'];
$video_description = $_POST['desc'];
$video_url = $_POST['url'];
$video_payment_type = 'payment_id';
$salt1 = Rand(62467537859, 7472475625728539);
$salt2 = Rand(523524626, 86867475757537357);
$salt3 = $salt1 . $salt2;
$video_token = md5($salt3);
$created_date = Date('d M Y H:i:s');
$video_token = $_POST['video_token'];
$old_banner = $_POST['old_banner'];

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
$path = 'data/'; // upload directory

// Check if image is set in POST data
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $img = $_FILES['image']['name'];
    $imgs = strtolower($img);
    $tmp = $_FILES['image']['tmp_name'];
    // Get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // Can upload same image using rand function
    $final_image = time() . $imgs;
    // Check valid format
    if (in_array($ext, $valid_extensions)) {
        $paths = $path . strtolower($final_image);
        // Add record with new image
        $video = new atwLive();
        $video->edit_Video($video_token, $video_title, $video_category, $video_description, $final_image, $video_url, $video_payment_type, $created_date, $pub_date, $pub_status);
        $link = 'src/' . $paths;
        move_uploaded_file($tmp, $paths);
        $file_path = __DIR__ . '/data/' . $old_banner; // Construct file path
        if (file_exists($file_path)) {
            unlink($file_path); // Delete the file
        }
        echo "<img width='50' src='$link' />";
    } else {
        echo 'Invalid image format.';
    }
} else {
    // No image attached, update without changing the image
    $video = new atwLive();
    $video->edit_Video($video_token, $video_title, $video_category, $video_description, $old_banner, $video_url, $video_payment_type, $created_date, $pub_date, $pub_status);
}
?>
