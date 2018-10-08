# sdh_symfony
- general web template
- usage:
    - SDH WEB
    -  pro ostatni - mozna pouziji i na web male kopane
       

Dodelat
---

- error pages - lepe customizovat
- rozdelit/sestavit vice layoutu - show, list, post, timeline, section, sidebar, leftbar atp,
- nahradit sample texty z databaze
- napsat testy unit testy - predevsim na managery, repository, controllery
- chybi entity Gallery a Gallery\Section, Technology, Unit, RSS\Channel
- ve slideru odpocitavadlo na nachazejici udalost + mapa s mistem udalosti
- dokoncit validator constrainty, vcetne prekladu constraintu!!
- dodelat entitu user- userInterface a metody jako getSalt
- nezapomenout vytvorit formulare  + csrf na tokeny
- problem s knihovnou Validation 
    - (v bundle chybi interfaceNonExistiningInterface
    - vendor\symfony\framework-bundle\Tests\Fixtures\Validation\Article.php)
    - overit zavislosti
    
- tabulky z CRUD do boostratp - sude a  liche + hover
- application - vytvorit ApplicationEvent/Listener - onError    
- logovani vyjimek?? nyni nelogujij vyjimky
- prepsat do bundles
- pridat ke clanku entitu Tag
- Application::getEnvironemt
- uvodni stranky prejmenovat na name - nezapomenout to upravit v twig sablonach
- udelat barudalosti
- vytvorit entitu CountDown
- zobrazit roli tester a developer i tu pravou hlasku
- nez budu davat jako ukazku, tak potreba pres consoli zakryptovat hesla
- v kontrolleru zajimave vyjimky napr. createAccessDeniedException
-vytvorit casovou osuSDH - je tam html timeline
- u manageru bude v construktoru vzdy nejaky authorizatotr, napr. autorizce k vytvareni ci delete clanku 
- pri zalogovani vyplnit lat logged at
- rozdelit security a user controlelr na user (crud app) a authController