#  **RetroCTA *(páros filmajánló)* komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens egy retro stílusú mozi landing oldal, amely a modern élményeket ötvözi a klasszikus hangulattal.

- **Fő felhasználói interakciók**:
  - Jegyvásárlás gomb
  - Heti vetítések gomb
  - Randi ötletek link

## **2. Külső függőségek**
- **Importok, csomagok**: storage kép-betöltési és lekérési import a backend *storage*-re mutatva, továbbá az útvonalak dinamikus kezelésére.

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**                  | **Funkció, stílusjegyek**                    |
| ------------------------- | -------------------------------------------- |
| `<div class="container">` | Fő konténer a kialakítás számára             |
| `<h2>`                    | Cím megjelenítése, stílusos tervezett textus |
| `<div>` (sor)             | Stílusos vízszintes vonal keresztmetszete    |
| `<button>`                | Jegyvásárlás és heti vetítések gombok        |
| `<img>`                   | Mozifotó megjelenítése                       |

## **4. Logika és interakciók**
- **Script setup tartalom**:
  ```javascript
  import { storage } from '@utils/http.mjs';
  ```
- **Eseménykezelés**: Gombokra kattintásnál navigáció a megfelelő linkekhez.
- **Reaktív adatok**: Nincs reaktív adat definiálva.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                 |
| ------------------ | --------------------------------------------- |
| **Színek**         | Rózsaszín és szürke árnyalatok, fekete háttér |
| **Betűtípus**      | Modern, jól olvasható betűtípus               |
| **Reszponzivitás** | Mobilbarát dizájn                             |
| **Effektek**       | Átmenetek, árnyékok és hover effektek         |

## **Tartalmi összefoglaló**
 A komponens célja, hogy egy vonzó landing oldalt biztosítson a klasszikus mozi élmények és modern kényelmi funkciók kombinálásával, segítve az használókat a jegyvásárlásban és a heti vetítések megtekintésében.
