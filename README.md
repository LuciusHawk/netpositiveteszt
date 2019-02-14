# netpositiveteszt
A feladat egy egy oldalas symfony alkalmazás készítése. Nyugodtan használhatsz bármilyen 3rd party libet, bundlet, bármit.

Tehát a feladat:

Készíts egy symfony alkalmazást, amely a következő feladatot oldja meg:

- Két különböző API-n keresztül lekért listát fűz össze bizonyos szabályok mentén.

- A két használandó API:

- Twitter: https://developer.twitter.com/en/docs/tweets/timelines/api-reference/get-statuses-user_timeline.html

- ICNDB: http://www.icndb.com/api/

- Az alkalmazás egy publikusan elérhető oldalon három paramétert fogad: "handle1", "handle2", "method".

- A "handle1" és "handle2" paraméterek kötelezőek, string típusúak, és nem lehetnek ugyanazok. (Ezen paraméterek alapján kell majd a megfelelő twitter fiók bejegyzéseit lekérdezni a twitter API-ból.)

- A "method" paraméter a következő értékeket fogadja el: "mod", "fib". (Ez a paraméter vezérli majd az ICNDB API-ból származó elemek helyét az eredménylistában.)

- A "method" paraméter megadása nem kötelező, alapértelmezett értéke: "fib".


Az URL struktúra a következő:

/:handle1/:handle2/:mod


Tehát pl. ezek valid url-ek az alkalmazáson belül:

/knplabs/symfony/mod

/symfony/knplabs/fib

/potus/github


A megvalósítandó oldal a "handle1" és "handle2" paraméterekhez tartozó twitter fiókok (pl. https://twitter.com/knplabs és https://twitter.com/symfony) legfrissebb 20-20 bejegyzését listázza ki, kiegészítve néhány listaelemmel az ICNDB-ből, a következő szabályokkal (példa lista lejjebb):


- A két twitter fiókhoz tartozó bejegyzések egy fordított időrendi sorrendben összefésült listában jelenjenek meg.

- "method" = "mod" esetében minden harmadik listaelem az ICNDB API által visszaadott random elem legyen.

- "method" = "fib" esetében minden olyan elem, aminek az eredménylistában levő sorszáma fibonacci szám, és a szám > 2, az ICNDB API által visszaadott random elem legyen.


Példa lista:


/knplabs/symfony/mod


| number | source | time | message |

| 1. | twitter/knplabs | 2018.01.01. 12:34 | This is a twitter message from the knplabs handle |

| 2. | twitter/symfony | 2018.01.01. 12:33 | This is a twitter message from the symfony handle |

| 3. | icndb | | This is a random message from icndb |

| 4. | twitter/symfony | 2018.01.01. 12:32 | This is a twitter message from the symfony handle |

| 5. | twitter/knplabs | 2018.01.01. 12:31 | This is a twitter message from the knplabs handle |

| 6. | icndb | | This is a another random message from icndb |

...


A listának nem kell szépnek lennie, pl. sima HTML táblázat bőven elég.
