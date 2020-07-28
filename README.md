# docs

Aplikace *docs* prochází adresáře na hostingu. Pokud tedy chcete vytvořit nějakou dokumentovou databázi, je to ideální nástroj.

Použití je jednoduché:
1. Stáhněte si jednu z verzí projektu.
2. Nahrajte na hosting soubor `index.php`.
	- Soubor je třeba nahrát do každého adresáře, kde chcete vypisovat obsah.
3. Do stejného adresáře k `index.php` nahrajte vaše soubory.
4. Pokud chcete, můžete přidat následující soubory:
    - **name.txt** - Do tohoto souboru napište nadpis stránky.
    - **info.txt** - Do tohoto souboru napište obsah stránky (popis adresáře). Můžete použít i `HTML` tagy.
    - **files.txt** - Do tohoto souboru napište seznam zobrazovaných jmen souborů. Vše ve formátu `ini` souboru (původní jméno=nové jméno). Seznam nemusí obsahovat všechny soubory v adresáři.
    - Pro správné zobrazení obsahu souborů ve stránce je doporučeno použít kódování `UTF-8`.
    - Tyto soubory aplikace nevypisuje.
    - Použití těchto souborů není povinné.
