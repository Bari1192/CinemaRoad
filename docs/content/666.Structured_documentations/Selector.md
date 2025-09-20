# **Selector komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens lehetőséget nyújt a felhasználóknak, hogy kiválasszanak egy mozihelyszínt, ahol különböző mozifilmek vetítései, filmtípusok szűrései érhetőek el.

- **Fő felhasználói interakciók**:
  - Helyszín megtekintése
  - Filmek típusa szerinti szűrés
  - Filminformációk megtekintése

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `useTicketStore`
  - `useMovieStore`
  - `useScreeningStore`
  - `BaseLayout`
  - `Stepper`
  - `BaseSpinner`
  - `ScreenTimePicker`
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**             | **Funkció, stílusjegyek**                               |
| -------------------- | ------------------------------------------------------- |
| `<BaseLayout>`       | Az oldal vázát biztosítja                               |
| `<Stepper>`          | A kiválasztott lépéseket mutatja                        |
| `<h1>`               | Helyszín címének megjelenítése                          |
| `<div>`              | Helyszínek és filmek megjelenítése rácsos elrendezésben |
| `<ScreenTimePicker>` | Vetítési időpontok kiválasztása és megjelenítése        |

## **4. Logika és interakciók**
- **Script setup tartalom**: A helyszínek, vetítések és filmek betöltése, valamint a kiválasztás logikája.
- **Eseménykezelés**: Kiválasztott helyszínre és vetítésekre kattintás.
- **Reaktív adatok**: `selectedGenre`, `currentLocationId`, `screenings`, `movies`, `filteredMoviesByType`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                   |
| ------------------ | ----------------------------------------------- |
| **Színek**         | Rózsaszín (címek), szürke háttér                |
| **Betűtípus**      | Nincs specifikálva                              |
| **Reszponzivitás** | Mobilbarát elrendezés                           |
| **Effektek**       | Átmenetek a gomboknál és a háttér homályosítása |

## **A komponenst tartalmi összefoglalója**
A komponens lehetőséget biztosít a felhasználóknak, hogy kiválasszák a kívánt mozihelyszínt és böngésszenek a vetítések között, lehetővé téve a premier filmek egyszerű megtekintését.