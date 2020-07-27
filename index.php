<?php
  $name = 'name.txt';
  $info = 'info.txt';
?>

<!DOCTYPE html>
<html lang="cs" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://voj-tech.wz.cz/services/web/apps/docs/css/master.css">
    <title><?php echo(substr($_SERVER['REQUEST_URI'], 1, -1)); ?></title>
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
        foreach (glob("*") as $soubor) {
          if ($soubor != 'index.php') {
            if ($soubor != $name) {
              if ($soubor != $info) {
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
                echo('<tr><td><img src="http://voj-tech.wz.cz/services/web/apps/docs/img/' . filetype($soubor) . '.png" alt="' . filetype($soubor) . '"></td><td><a href="' . $soubor . '">' . $soubor . '</a></td><td>' . $velikost . '</td><td>' . date('j.n. Y H:i:s', filemtime($soubor)) . '</td></tr>');
              }
            }
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
      <p>powered by <a href="http://appportal.hys.cz/doku.php?id=projekty:web:apps:docs">docs</a></p>
      <p>&copy; <?php echo($roky); ?> <a class="vt" href="http://voj-tech.wz.cz/">Voj-Tech</a></p>
    </footer>
  </body>
</html>
