<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CTF RFI Challenge</title>
    <style>
        body {
            font-family: monospace;
            background-color: #121212;
            color: #00ff00;
            padding: 40px;
        }

        h1 {
            color: #0f0;
        }

        .folder-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 30px;
        }

        .folder {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #0f0;
            transition: 0.2s ease;
        }

        .folder:hover {
            color: #fff;
        }

        .folder img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            filter: invert(100%);
        }

        .footer {
            margin-top: 60px;
            color: #555;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h1>📁 CTF - Remote File Inclusion</h1>
    <div class="folder-list">
        <a href="rfi_dasar/" class="folder">
            <img src="icon-folder.png" alt="folder"> rfi_dasar/
        </a>
        <a href="rfi1/" class="folder">
            <img src="icon-folder.png" alt="folder"> rfi1/
        </a>
        <a href="rfi2/" class="folder">
            <img src="icon-folder.png" alt="folder"> rfi2/
        </a>
    </div>
    <div class="footer">Challenge for educational purpose only.</div>
</body>
</html>
