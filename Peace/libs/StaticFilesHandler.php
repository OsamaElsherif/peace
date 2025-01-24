<?php
namespace Peace\libs;

class StaticFilesHandler
{
    public static function handle(string $uri): bool
    {
        

        $baseDir = __DIR__ . DIRECTORY_SEPARATOR;
        
        $baseDir = str_replace(DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR, '', $baseDir);
        // convert uri to full path
        $uriPath = str_replace('/', DIRECTORY_SEPARATOR, $uri);
        //remove the lib from the path since it is inside the base_dir.
        $filePath = str_replace(DIRECTORY_SEPARATOR.'libs'.DIRECTORY_SEPARATOR, '', $baseDir);
        // combine paths
        $filePath = $filePath . $uriPath;

        if ($filePath && strpos($filePath, $baseDir) === 0 && is_file($filePath)) {
            // $mimeType = mime_content_type($filePath);
            // header("Content-Type: $mimeType");
            readfile($filePath);
            return true;
        }
        return false;
    }
}