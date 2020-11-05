<?php
    function sortFiles($soubory = array()) {
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