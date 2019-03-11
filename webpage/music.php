<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
 "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <title>Music Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link href="viewer.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <div id="header">
        <h1>190M Music Playlist Viewer</h1>
        <h2>Search Through Your Playlists and Music</h2>
    </div>


    <div id="listarea">
        <ul id="musiclist">
            <?php
            $playlist = isset($_GET["playlist"]) ? $_GET["playlist"] : null;
            $folder = "songs";
            $files = $playlist != null ? file("songs/" . $playlist) : scandir($folder);
            foreach ($files as $filename) {
                $filename = trim($filename);
                $filesize = filesize($folder . "/" . $filename);
                if (preg_match('/mp3$/m', $filename)) {
                    if ($filesize < 1024) $sizestr = $filesize . " b";
                    else if ($filesize < 1048576) $sizestr = (round($filesize / 1024, 2)) . " kb";
                    else $sizestr = (round($filesize / 1048576, 2)) . " mb";
                    ?>

                    <li class="mp3item">
                        <a href="songs/<?= $filename ?>">
                            <?= $filename ?></a>
                        (
                        <?= $sizestr ?>)
                    </li>
                    <?php
                }
            }
            foreach ($files as $filename) {
                if (preg_match('/txt$/m', $filename)) {
                    ?>
                    <li class="playlistitem">
                        <a href="?playlist=<?= $filename ?>">
                            <?= $filename ?></a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
    </div>
</body>

</html> 