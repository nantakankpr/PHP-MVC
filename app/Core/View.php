<?php

namespace App\Core;

class View
{
    public static function render($view, $data = [], $layout = "default")
    {
        extract($data);

        // Construct paths using DIRECTORY_SEPARATOR or consistent slashes
        $viewPath = __DIR__ . "/../../app/Views/{$view}.php";
        $layoutPath = __DIR__ . "/../../app/Views/layouts/{$layout}.php";

        // Check if view file exists and include it
        if (file_exists($viewPath)) {
            ob_start();
            require $viewPath;
            $content = ob_get_clean();
        } else {
            throw new \Exception("View file not found: {$viewPath}");
        }

        // Check if layout file exists and include it
        if (file_exists($layoutPath)) {
            // Pass the captured content to the layout
            require $layoutPath;
        } else {
            throw new \Exception("Layout file not found: {$layoutPath}");
        }
    }

    public static function response($statusCode, $message, $data = [])
    {
        http_response_code($statusCode);
        header('Content-Type: application/json;');
        $resData = [
            'status_code' => $statusCode,
            'message' => $message,
        ];
        if (sizeof($data) > 0) {
            $resData['data'] = $data;
        }
        echo json_encode($resData);
        exit();
    }
}
