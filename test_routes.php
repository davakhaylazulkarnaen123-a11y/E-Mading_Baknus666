<?php
// Simple route test script
// Run this from command line: php test_routes.php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

echo "Testing E-Mading Routes...\n\n";

// Test if routes are loaded
try {
    $routes = $app->make('router')->getRoutes();
    echo "✓ Routes loaded successfully\n";
    echo "Total routes: " . count($routes) . "\n\n";
    
    // List some key routes
    $keyRoutes = ['home', 'login', 'dashboard', 'artikel.create', 'artikel.store'];
    
    foreach ($keyRoutes as $routeName) {
        try {
            $route = route($routeName);
            echo "✓ Route '{$routeName}': {$route}\n";
        } catch (Exception $e) {
            echo "✗ Route '{$routeName}': ERROR - {$e->getMessage()}\n";
        }
    }
    
} catch (Exception $e) {
    echo "✗ Error loading routes: " . $e->getMessage() . "\n";
}

echo "\n";
echo "If routes are working, the 404 issue might be:\n";
echo "1. Web server configuration\n";
echo "2. Database connection\n";
echo "3. Missing storage directories\n";
echo "4. File permissions\n";
?>