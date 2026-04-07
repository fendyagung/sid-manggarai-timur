<?php
$file = 'd:/SID Manggarai Timur/database_sid_manggarai.sql';
if (file_exists($file)) {
    $content = file_get_contents($file);
    
    // Check for UTF-16 Little Endian BOM (255 254)
    if (substr($content, 0, 2) === "\xFF\xFE") {
        // Convert from UTF-16LE to UTF-8
        $content = mb_convert_encoding($content, 'UTF-8', 'UTF-16LE');
        // Remove the BOM from the beginning if it exists after conversion
        $content = ltrim($content, "\xEF\xBB\xBF");
        file_put_contents($file, $content);
        echo "Successfully converted UTF-16LE to UTF-8.\n";
    } else {
        echo "File is not UTF-16LE or already converted.\n";
    }
} else {
    echo "File not found.\n";
}
