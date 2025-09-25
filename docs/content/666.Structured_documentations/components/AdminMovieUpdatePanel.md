# **AdminMovieUpdatePanel komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens lehetővé teszi a filmek módosítását, beleértve a részletes információik megjelenítését és szerkesztését egyetemlegesen.

- **Fő felhasználói interakciók**:
  - Filmek szerkesztése
  - Film törlése
  - Hibaüzenetek megjelenítése

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `useMovieStore` (filmek tárolása)
  - `ToastService` (értesítések)
  - `useUserStore` (felhasználói tárolás)
  - `storage` (képkezelés)
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**   | **Funkció, stílusjegyek**                                    |
| ---------- | ------------------------------------------------------------ |
| `<h1>`     | Filmek módosításának címe                                    |
| `<input>`  | Film címének, rendezőjének és megjelenési dátumának bevitele |
| `<select>` | Film típusának kiválasztása                                  |
| `<button>` | Film mentése és törlése                                      |
| `<img>`    | Film posztere                                                |

## **4. Logika és interakciók**
- **Script setup tartalom**: `editableMovies`, mint reaktív változó a filmek tárolására, `onMounted` metódus a felhasználói adatok betöltésére.
- **Eseménykezelés**: `saveEdit` és `deleteMovie` metódusok, amelyek a filmek szerkesztéséhez és törléséhez kapcsolódnak.
- **Reaktív adatok**: `editableMovies`, `userStore`, és `movieStore`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                     |
| ------------------ | ------------------------------------------------- |
| **Színek**         | Rózsaszín, indigó és lila színű háttér            |
| **Betűtípus**      | Nincs specifikálva                                |
| **Reszponzivitás** | Mobilbarát elrendezés                             |
| **Effektek**       | Hover állapotok és dinamikus animációk a gombokon |

## **A komponenst tartalmi összefoglalója**
A komponens lehetőséget biztosít az adminoknak, moderátoroknak, hogy a kiválasztott filme(ke)t módosítsanak, töröljenek és az aktuális állapotukat megtekintsé, lekérdezzék.