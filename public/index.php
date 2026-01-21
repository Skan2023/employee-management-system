<?php
// public/index.php

// Load configuration
require_once '../app/config/Config.php';

// Load core classes
require_once '../app/core/App.php';
require_once '../app/core/Controller.php';
require_once '../app/core/Model.php';

// Load database
require_once '../app/config/Database.php';

// Initialize application
$app = new App();