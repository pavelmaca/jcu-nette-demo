Demo ukázka pro PHPkáře

## Itinerář k prezentaci

1) Obecný úvod
    * (otevřít nette.org)
    * Co jsou to frameworky, jak vznikly a proč
    * Stáhnout Nette Framework
 2) Mechanismus fungování
    * Rozbalit framework, ukázat kde co je, vykopírovat sandbox
    * Kde hledat informace? (otevřít doc.nette.org)
    * Nad schemátkem v dokumentaci vysvětlit adresářovou strukturu
    * Ukázat kauzalitu akcí: index.php -> bootstrap.php -> configy (jen zmínit kde jsou, vrátíme se k nim) -> ...
    * ... -> Router (příjde request, router rozebere a zvolí Presenter a View)
    * A kde jsou ty prezentery? Ukázat třídu prezenteru, že dědí a má metody.
    * Název prezenterů a jejich metod musí dodrřovat určité konvence, ukázat živnotní cyklus presenteru - ergo co se volá.
    * Pochválit Davídka za autoloading
    * Ukázat, kde jsou uloženy šablony.
3) Hello world
    * Zkusíme do toho sáhnout: Máme k dispozici Homepage presenter s default view + šablonku k tomu.
    * Šablonu default.latte vyprázdnit, ukázat bloky a @layout.latte - jen základy.
    * Předat do šablony nějakou proměnnou primitivního typu - např. oslovení.
    * Ukázat ochranu proti XSS - HTML znaky se při výpisu řetězce nahrazují entitami (ukázat i zdroják v prohlížeči).
4) Zobrazení článků
    * Chceme zobrazovat články - jedna samottný článek, jednak jejich seznam: K tomu vytvoříme ArticlePresenter se dvěma view (default, show) a příslušné šybloky, kam dáme zatím nějaký statický dummy obsah.
    * Udělat si odkaz na ArticlePresenter z Homepage:default. Jak se dělají odkazy? Oproti absolutním cestám se používají relativní odkazy na Presenter-View + parametry. Router funguje v obo směrech - jak na rozebrání URL na MVP, tak na sestavení URL podle MVP odkazu. Dva způsoby - {link} a n:href=""
    * Kde vzít data? Od toho máme v MVP přeci model: Vytvořit ArticleModel
    * Model potřebuje DB - vysvětlit služby: Co je vlastně model? Je to služba, která poskytuje presenteru data. Databáze je taky služba. Pokud na části aplikace nahlížíme jako na služby, podporujeme zapouzdření. Služby se registrují v configu.
    * Pomocí admineru vytvořit databázi (spustit SQL)
    * Přejít do configu a připojit se k DB - tj. vytváříme službu databáze
    * Jak dostaneme DB do modelu? Dependency injection: V ArticleModelu přidat příslušnou proměnnou a konstruktor. (princip DI: služba je líná, neobstará si potřebné závislosti sama, když od ní někdo něco chce musí jí nějdřív sám zařídit co potřebuje)
    * Zaregistrovat ArticleModel do configu
    * Vytvořit metody getArticle($id) a getAllArticles(), pomocí anotací ukázat co vracejí za typ dat.
    * Jak si sáhnout na model v prezenteru? Stejně jako si model sahá na DB - jako na službu: Předávat přes konstruktor - nezapomenout zavolat konstruktor předka (BasePresenter).
    * Předat data z modelu do šablonek v render metodách. (začal bych postupně - nejdříve renderDefault, pak renderShow)
    * Doplnit implementaci šablonky renderDefault:
        * Ukázat jak se dotazovat do DB pomocí Nette Database (průběžně ukazovat výsledek)
        * Ukázat {foreach}
        * Odkaz na článek
    * Doplnit implemnetaci šablonky renderShow (nezapomentou na odkaz zpět na default).
5) Komentáře
    * Vytvořit v ArticlePresenter továrničku s formulářem - nejprve vytvořit, pak ukázat vykreslení, poté doplnit onSuccess (dummy, dump výstupu).
    * Jak to ukádat? V ArticleModel vyvořit metodu addComment($id, $data).
    * Je potřeba předat ID článku - přes hidden položku to není úplně idedální - může do toho být zasáhnuto. Je nutné předávat jako instanční proměnnou - pomocí actionShow - viz životní cyklus! (možná ukázat chybu).
    * Přidáme obsah onSuccess, vč. flashMessages a ukážeme že se nám něco píše do DB. Ukážemé také jak fungují validační pravidla.
    * Do článku doplníme výpis komentářů, použijeme related().
    * Zmínit redirect, ukázat jak si s stím poradí Tracy, ukázat ladící výpisy databáze.
6) Změna routování
    * Nelíbí se mi routování, chci ho změnit - díky Nette mohu. Přidáme routu pro články.
    * Ukážeme automatické přesměrování, routovací tabulku v Tracy, (jen zmíníme) další možnosti filtrování, ONE_WAY, překlady a spol.
7) Paging
    * Pomocí Nette/Utils/Paginator
    * Ukázka použití signálů - tj. když se něco stane v rámci jednoho view (handlePage)
    * Ukáyka toho, proč je dobré mít z modelu "nehotové" databázové dotazy.
7) Když zbyde čas
    * Vyšperkovat bootstrapem.
    
        
        
