<?php
  $name = 'name.txt';
  $info = 'info.txt';
  $files = 'files.txt';

  function vyhodnot($soubor, $name, $info, $files) {
    return($soubor != 'index.php' && $soubor != 'admin.php' && $soubor != $name && $soubor != $info && $soubor != $files);
  }

  function serad($soubory = array()) {
    $abecedne = $soubory;
    sort($abecedne);
    $slozkove = array();

    foreach ($abecedne as $soubor) {
      if (filetype($soubor) === 'dir') {
        $slozkove[] = $soubor;
      }
    }

    foreach ($abecedne as $soubor) {
      if (filetype($soubor) === 'file') {
        $slozkove[] = $soubor;
      }
    }

    return $slozkove;
  }
?>

<!DOCTYPE html>
<html lang="cs" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://voj-tech.wz.cz/services/web/apps/docs/css/master.css">
    <title>
      <?php
        if (file_exists($name)) {
          echo(file_get_contents($name));
        } else {
          echo(substr($_SERVER['REQUEST_URI'], 1, -1));
        }
      ?>
    </title>
  </head>
  <body>
    <?php if(file_exists($name)): ?>
      <h1>
        <?php echo(file_get_contents($name)); ?>
      </h1>
    <?php endif; ?>
    <?php if(file_exists($info)): ?>
      <p>
        <?php echo(file_get_contents($info)); ?>
      </p>
    <?php endif; ?>
    <ul>
      <li><a href="..">..&#171;- zpět</a></li>
    </ul>
    <table>
      <?php
        $soubory = serad(glob('*'));
        foreach ($soubory as $soubor) {
              if (vyhodnot($soubor, $name, $info, $files)) {
                $velikost = filesize($soubor) . ' B';
                if ($velikost > 1000) {
                  $velikost = number_format(substr($velikost, 0, -2) / 1000, 0, '.', '');
                  $velikost = $velikost . ' kB';
                  if ($velikost > 1000) {
                    $velikost = number_format(substr($velikost, 0, -3) / 1000, 0, '.', '');
                    $velikost = $velikost . ' MB';
                    if ($velikost > 1000) {
                      $velikost = number_format(substr($velikost, 0, -3) / 1000, 0, '.', '');
                      $velikost = $velikost . ' GB';
                      if ($velikost > 1000) {
                        $velikost = number_format(substr($velikost, 0, -3) / 1000, 0, '.', '');
                        $velikost = $velikost . ' TB';
                      }
                    }
                  }
                }
                echo('<tr><td><img src="http://voj-tech.wz.cz/services/web/apps/docs/img/' . filetype($soubor) . '.png" alt="' . filetype($soubor) . '"></td><td><a href="' . $soubor . '">');
                  if (isset($fileName) && isset($fileName[$soubor])) {
                    echo(htmlspecialchars($fileName[$soubor]));
                  } else {
                    echo(htmlspecialchars($soubor));
                  }
                echo('</a></td><td>' . $velikost . '</td><td>' . date('j. n. Y H:i:s', filemtime($soubor)) . '</td></tr>');
              }
            }
      ?>
    </table>
    <?php
      if (date('Y') == '2020') {
        $roky = '2020';
      } else {
        $roky = '2020 - ' . date('Y');
      }
    ?>
    <footer>
      <p>powered by <a href="http://appportal.hys.cz/doku.php?id=projekty:web:apps:docs">docs 3.0</a></p>
      <p>&copy; <?php echo($roky); ?> <a class="vt" href="http://voj-tech.wz.cz/">Voj-Tech</a></p>
    </footer>
  </body>
</html>
