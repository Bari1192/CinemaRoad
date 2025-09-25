# **CreateMovie (film létrehozás) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens lehetővé teszi a felhasználók számára, hogy új filmeket hozzanak létre, feltöltsenek posztert és megadják a filmhez tartozó adatokat.

- **Fő felhasználói interakciók**:
  - Poszter feltöltése
  - Film címének és leírásának megadása
  - Film műfajának és korhatár-besorolásának kiválasztása
  - Film rendezőjének, és színészeinek feltöltése
  - Kész filminformációk mentése

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout` (vázlat)
  - `ToastService`, `useUserStore`, `useMovieStore`, `router`, `storage`, `http` (különböző funkciók)
  - `FormKit` (űrlapkezelés)
  - `Toast` (értesítések)
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**              | **Funkció, stílusjegyek**                                            |
| --------------------- | -------------------------------------------------------------------- |
| `<h1>`                | Oldal címe, középre igazítva, rózsaszín színnel és nagy betűmérettel |
| `<input type="file">` | Poszter feltöltésére szolgáló fájlbeviteli mező                      |
| `<img>`               | Feltöltött poszter előnézeti képe                                    |
| `<Input>` (FilmKit)   | Film címe és hossza, beviteli mezők, rózsaszín kerettel              |
| `<textarea>`          | Film leírására és a színészek bevitelére szolgáló szöveget tartalmazó mező                               |
| `<select>`            | Műfaj és korhatár-besorolás választása                               |
| `<button>`            | Film mentése, interaktív gomb                                        |

## **4. Logika és interakciók**
- **Script setup tartalom**:
  - A komponens reaktív változókat definiál, mint pl. `movieTitle`, `movieDurationMin`, `src` stb.
- **Eseménykezelés**:
  - Kép választásánál `onFileChange` metódus; mentés gombnyomásra `handleCreateMovie` metódus.
- **Reaktív adatok**:
  - `computed` változók, mint `actorsArray` és `missingInputs`, amelyek dinamikusan frissülnek a felhasználói interakciók során.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                                       |
| ------------------ | ------------------------------------------------------------------- |
| **Színek**         | Rózsaszín betűszín fehér háttérrel (címek), lila színátmenetes (háttér)                                  |
| **Betűtípus**      | Nincs specifikálva a kódban                                         |
| **Reszponzivitás** | Mobilra optimalizált, változó elrendezés különböző képernyőmérethez |
| **Effektek**       | Hover állapotok a gomboknál                                         |

## **A komponens tartalmi összefoglalója**
A komponens célja, hogy lehetőséget biztosítson új filmek létrehozására és adatainak megadására, beleértve a poszter feltöltését és a film részleteit.
