<?php
    // define("DB_HOST", "localhost");
    // define("DB_USER", "schoolportal_fcpc_edu_ph_user");
    // define("DB_PASS", "sDKmksGWX#R7qScX62c4");
    // define("DB_NAME", "schoolportal_fcpc_edu_ph");

    define("DB_HOST", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "sacred");
    define("DB_NAME", "schoolportal_fcpc_edu_ph");

	//$servername = "localhost";
	//$serverusername = "root";
	//$serverpassword = "";
	//$serverdb = "fcpc_school_portal";
	
    //define("DB_HOST", "184.168.101.93");
    //define("DB_USER", "dbschoolportal");
    //define("DB_PASS", "FCPCsince1984");
    //define("DB_NAME", "fcpc_school_portal");
    
	define("DB_PORT", "3307");
	//define("DB_CHARSET", "utf8mb4");
	
    // define("DB_HOST", "184.168.101.93");
    // define("DB_USER", "dbschoolportaltest");
    // define("DB_PASS", "FCPCsince1984");
    // define("DB_NAME", "fcpc_school_portaltest");

    define('RECAPTCHA_SECRET', '6LfweHorAAAAAFx4tlpPMzqSRfJuHGwL-Dforik7');

    define("SMTP_HOST", "smtp.gmail.com");
    // define("SMTP_USER", "schoolportalnotification@fcpc.edu.ph"); // changed to 1: 04-15-2025
    define("SMTP_USER", "schoolportalnotification1@fcpc.edu.ph");
    define("SMTP_PASS", "zruu gsle orhx iirh");
    define("SMTP_PORT", 587); // or 465 for SSL

    define("SMTP_FROM", "schoolportalnotification@fcpc.edu.ph");
    define("SMTP_FROM_NAME", "FCPC ICT Department");

    // Data encryption and decryption
    // ✅ Put your secret key somewhere safe (like an .env file)
    define('SECRET_KEY', 'b39fb02ea5551fa6b099d80dc8dadb2e041249aa000b0610e7afc07b8871ffdf'); // 32 bytes for AES-256
    define('CIPHER_METHOD', 'aes-256-cbc');

    // Password Hashing Config
    // define('MEMORY_COST', 1 << 18);
    // define('TIME_COST', 4);
    // define('THREADS', 2);

    define('MEMORY_COST', 1 << 16); // 65536 KiB = 64 MB (lower than 256 MB)
	define('TIME_COST', 2);         // Keep time cost reasonable
	define('THREADS', 1);

    $options = [
        'memory_cost' => MEMORY_COST,
        'time_cost'   => TIME_COST,
        'threads'     => THREADS,
    ];
?>