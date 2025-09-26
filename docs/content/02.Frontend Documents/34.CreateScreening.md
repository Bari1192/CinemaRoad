# **CreateScreening *(vetítési nap összeállító)* komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: Ez a komponens lehetővé teszi, hogy a felhasználó kiválassza a mozi helyszínét és a vetítési napját, valamint kezelje a filmajánlatokat.

- **Fő felhasználói interakciók**:
  - Mozi helyszínének kiválasztása.
  - Vetítési nap kiválasztása.
  - Filmek kiválasztása a vetítési napra.
  - Összeállítás újrakezdése.
  - Vetítési nap mentése.

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `@utils/http.mjs`
  - `@stores/ToastService`
  - `@layouts/BaseLayout.vue`
  - `vue-router`
  - `@stores/MovieStore.mjs`
  - `@stores/DriveInCinemaStore`
  - `@stores/UserStore`
  - `@stores/ScreeningStore.mjs`

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**                          | **Funkció, stílusjegyek**                                 |
| --------------------------------- | --------------------------------------------------------- |
| `<h1>`                            | Cím, középre igazítva, nagyobb betűméret, kiemelt stílus. |
| `<div>`                           | Színes háttér, árnyék, kerekített sarkok.                 |
| `<label>`                         | Bemeneti mezőkhöz címke, kiemelt betűstílus.              |
| `<button>`                        | Kattintható elem, színes háttér, árnyék.                  |
| `<select>`                        | Választó elem, szöveges opciókkal.                        |
| `<input>`                         | Dátumválasztó, stílusozott, interaktív.                   |
| `<img>`                           | Kép elemek, kerekített sarkok, képfeltöltési hibakezelés. |
| `<button>` (vetítési nap mentése) | Kattintható gomb, középre alignelt, kiemelt stílus.       |

## **4. Logika és interakciók**
- **Script setup tartalom**: A Vue 3 setup API használatával definiált reaktív változók és komputált függvények, mint a kiválasztott filmek, mozi és dátumok kezelése.
- **Eseménykezelés**: Kattintási események a mozi és film kiválasztására, valamint a vetítési nap mentésére.
- **Reaktív adatok**: `selectedMovies`, `isOpen`, `selectedValue`, `selectedDate` stb.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                |
| ------------------ | -------------------------------------------- |
| **Színek**         | Fehér háttér, piros és indigó árnyalatok.    |
| **Betűtípus**      | Kiemelt stílusok, nagyobb címek.             |
| **Reszponzivitás** | Flexbox és grid használata az elrendezéshez. |
| **Effektek**       | Hover állapotok, árnyékok, színek változása. |

## **A komponens tartalmi összefoglalója**
A komponens célja, hogy az oldal **moderátorai (adminok)** egyszerűen kiválaszthassák a **mozi helyszínét**, a **vetítési napot**, és a **filmeket**, ezzel könnyen és hatékonyan új vetítési nap összeállítását téve elérhetővé.
