<?php
$output = '';

if (isset($_GET['cmd'])) {
    $allowed_cmds = ['ls', 'cat', 'whoami', 'id', 'bash'];
    $denied_cat_targets = ['shell.sh', 'scr.sh']; // file yang tidak boleh dibaca

    $cmd = trim($_GET['cmd']);
    $cmd_parts = explode(' ', $cmd);
    $cmd_base = $cmd_parts[0];

    if (in_array($cmd_base, $allowed_cmds)) {
        // Blok khusus untuk 'cat' dan blacklist file tertentu
        if ($cmd_base === 'cat') {
            $is_denied = false;
            foreach ($denied_cat_targets as $deny) {
                if (strpos($cmd, $deny) !== false) {
                    $is_denied = true;
                    break;
                }
            }

            if ($is_denied) {
                $output = "gk_boleh_cat_file_terlarang";
            } else {
                ob_start();
                system($cmd);
                $output = ob_get_clean();
            }
        } else {
            // command selain 'cat'
            ob_start();
            system($cmd);
            $output = ob_get_clean();
        }
    } else {
        $output = "gk_boleh";
    }
} elseif (isset($_GET['page'])) {
    ob_start();
    include($_GET['page']);
    $output = ob_get_clean();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Remote File Inclusion (RFI)</title>
    <style>
        body {
            background: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 40px;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #222;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        form {
            margin-bottom: 20px;
        }

        .inline-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        input[type="text"] {
            flex: 1;
            padding: 10px;
            font-size: 16px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 16px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .output {
            background-color: #eeeeee;
            padding: 10px;
            border-radius: 8px;
            font-family: monospace;
	    font-size: 14px;
            border: 1px solid #ccc;
        }

        .rfi-btn {
            display: block;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Remote File Inclusion (RFI)</h1>
        
        <!-- Inline input form -->
        <form method="get" action="" class="inline-form">
            <input type="text" name="page" placeholder="Enter page path, e.g., test.php">
            <button type="submit">Submit</button>
        </form>

        <!-- RFI load button -->
        <form method="get" action="">
            <button type="submit" name="page" value="test.php" class="rfi-btn">Remote File Inclusion</button>
        </form>

        <!-- Output display -->
        <?php if (!empty($output)): ?>
            <div class="output">
                <?= $output ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
