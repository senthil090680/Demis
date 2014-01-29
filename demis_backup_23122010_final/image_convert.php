$theFile = base64_decode($image_data);
$file = fopen('test.jpg', 'wb');
fwrite($file, $theFile);
fclose($file);

echo '<img src=test.jpg>';