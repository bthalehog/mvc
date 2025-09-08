# My repo README

Welcome to the README-file for my github-repo for the course Mvc givet at BTH.

https://github.com/bthalehog/mvc  

## About this repository
This repository exists as part of the course MVC given at BTH 2025.
The repo holds information on repo activity and tagging for all stages of the course.

- About this repository
- Clone and start
- Action log
- Badges

## Clone and start

Install the following:
    - PHP 8.1 or higher
    - Composer
    - Git
    - Node.js
    - Encore
    - Symfony  
                   
Clone the repository  
    -  git clone 'repository-directory'  
    - cd 'project-directory'  
                         
Install dependencies  
    - composer install  
    - npm install  
                    
Run build and launch   
    - npm run build  
    - symfony server:start  
    - Open in browser 'http://127.0.0.1:8000'  

## Action log

### _Kmom01_
20250402 Added base structure for webpage (Symfony).   
20250402 Created routes.  
20250407 Uploaded kmom01.  
20250409 Fixed path picture in README.  
20250410 Fixed hash-routing for report viewing.  
20250410 Introduced new tag v1.0.1 for finalizing before hand in.  
20250410 Fixed report view background by adding article-element to report.  
20250410 Introduced new tag v1.0.2 for backup before handing in.  
20250414 Added tag for finalized version, uploaded finalized version.  

### _Kmom02_  
20250419 Initial upload Kmom02 - Controller and Classes  
20250419 Updated README  
20250420 Updated Classes (not yet in use) for cardgame, Updated README.  
20250421 Introduced new tag v2.0.1, updated cardgame classes.  
20250421 New tag v2.0.2, shifted complexity from card- to deck-class, turned deck-function into deck-method, all classes now functional.  
20250421 New tag v2.0.3, Controller and views working, starting on graphics.  
20250421 New tag v2.0.3, Graphics working, routes working, need final functionality to classes.  
20250421 New tag v2.0.4, Fixed overflow of echo/print_r leaking into hmtl. Added functionality to classes for final criteria. Views working.  
20250421 New tag v2.0.5, Routing to other templates for card working.   
20250421 New tag v2.0.6, All routes for cardgame-func done, UML-created and published.  
20250422 New tag v2.0.7, Implementing session for selected functionality.  
20250422 New tag v2.1.0, Session implemented. Report embryo added. Initializing final touches.  
20250422 New tag v2.1.1, Kmom02 done, report finished, uploaded to server.  
  
### _Kmom03_  
20250428 New tag v3.0.0, Initial upload Kmom03 - Planning and modeling phase.  
20250428 New tag v3.0.1, Added basic routes - Phase 1 OK.  
20250430 New tag v3.0.2, Migrated classes from Geany, all functionality tested and working. Next: implement flowchart in Controller.  
20250430 New tag v3.0.3, Corrective push.   
20250430 New tag v3.0.4, Cardgame startpage, rules, form and button to start game added. Controller initiated, functionality tested - OK.  
20250501 New tag v.3.0.5, Cardgame session, start menu, basic routing OK.  
20250503 New tag v3.0.6, Cardgame game logic, in process.  
20250504 New tag v3.0.7, Cardgame game logic refinement, adding delay, next player, bet, and setScore in process.  
20250506 New tag v3.0.8, Cardgame restructure, encapsulation and methodization of game logic, fixing unresponsive layout changes and queue-logic.    
20250506 New tag v3.0.9, Restructure tested, unresponsive layout fixed (session-issue), playerIndex added to game-Class for queue-handling, reroute OK. Finalizing specialCases algoritm.  
20250507 New tag v3.1.0, SpecialCases finished, documentation done, report done, finish touches on layout, verifying compareHands-method.  
20250602 New tag v3.1.1, LINTing, more encapsulation, less static functions, clean old and decommissioned methods, layoutfix, api-landing fixed.  
20250603 New tag v3.1.2, Minor game-info-clean up, started with testing, player-controlled-bank decommissioned.  
  
### _Kmom04_  
20250603 New tag v4.0.0, Unit-testing initiated, card-class finished.  
20250603 New tag v4.0.1, Unit-testing continues, cardHand-class finished.  
20250603 New tag v4.0.2, Unit-testing continues, deckOfCards-class finished.  
20250604 New tag v4.0.3, Unit testing continues, Halfway through TwentyOne-class; restructured and patched flawed methods determineWinner(), firstTurn(), lastPlayer(), getWinner().  
20250604 New tag v4.0.4, Unit testing continues, 70% line coverage achieved, all classes tested, fixing error in is21()-method.  
20250608 New tag v4.0.5, Unit testing finished, game-logic classes fixed, assignment criteria met.  

### _Kmom05_  
20250611 New tag v5.0.0, Kmom05 Excercise, setup SQLite, db and repository.  
20250612 New tag v5.0.1, Kmom05, db and repository added for assignment, landing page created, app-layout done.  
20250614 New tag v5.0.2, Remodeled for GET/POST-criteria, layout change, forms and table-structure added.  
20250615 New tag v5.0.3, Styled forms and tables, fixed routing errors and path-errors in update form, added API-routes.  
20250616 New tag v5.0.4, Upload image finally working, finalized styling, report added.  
20250616 New tag v5.0.5, Example entries updated, linting and doc-commands run, assignment tested. Handing in Kmom05.  

### _Kmom06_

20250617 New tag v6.0.0, Kmom06 Excercises and base page-structure.  
20250617 New tag v6.0.1, Kmom06 Analysis in process, badges added.

### _Kmom10_ 
20250815 New tag v10.0.0, Kmom10 started, base structure set, room database JSON, Controller basics, storageHandler.  
20250816 New tag v10.0.1, Move-route and move()-function added, navigation made into form for value-retrieval.  
20250818 New tag v10.0.2,  
20250822 New tag v10.0.3, Storage updated and working, inventory-class added and implemented, constructors modified.  
20250825 New tag v10.0.4, Inventory, addItem fixed, clickable areas added, saveGameData fixed, inventory-methods added, restructured and added database items".  
20250901 New tag v10.0.5, Select item working, objectInteraction working, added saveState-calls in item-methods, moved select to server-side.  
20250902 New tag v10.0.6, Added "gates" to database, RoomHandler move function updated with gate-logic, reduced nesting.  
20250903 New tag v10.0.7, All room routing working, radio enabled to play audio on interaction.  
20250904 New tag v10.0.8, Added checks for forklift and radio in js clickedItem, updated objectInteraction, added finalMove-check, added about-route, reset on deathtrap and final_move.
20250906 New tag v10.0.9, Updated README, key-selected click interaction with forklift fixed, all resets working.  
20250907 New tag v10.1.0, Cleared unused functions, added unittest for Inventory and RoomHandler  
20250908 New tag v10.1.1, Added unittest for StorageHandler  
20250908 New tag v10.1.1, Updated readme  

### Badges earned
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bthalehog/mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/bthalehog/mvc/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/bthalehog/mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/bthalehog/mvc/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/bthalehog/mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/bthalehog/mvc/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/bthalehog/mvc/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence)

### Badges earned for kmom10
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bthalehog/mvc/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/bthalehog/mvc/?branch=main)
[![Code Coverage](https://scrutinizer-ci.com/g/bthalehog/mvc/badges/coverage.png?b=main)](https://scrutinizer-ci.com/g/bthalehog/mvc/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/bthalehog/mvc/badges/build.png?b=main)](https://scrutinizer-ci.com/g/bthalehog/mvc/build-status/main)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/bthalehog/mvc/badges/code-intelligence.svg?b=main)](https://scrutinizer-ci.com/code-intelligence) // update these

![](./public/img/bwtailgun.png)
