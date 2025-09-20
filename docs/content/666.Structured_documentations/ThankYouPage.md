# **Foglalás/Vásárlás Utáni visszaigazoló komponens (ThankYouPage) dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens megköszöni a felhasználónak a foglalását vagy vásárlását, és megjeleníti a megerősítő információkat.
- **Fő felhasználói interakciók**:
  - Foglalás vagy vásárlás kódjának megtekintése
  - Visszalépés a főoldalra
  - A felhasználó / vendég tájékoztatása, megerősítő e-mailre való reflektáció.

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `BaseLayout`
  - `useUserStore`
  - `useRouter`
  - `ToastService`
  - `Toast` (PrimeVue)
- **Betűtípusok, CDN-ek**: Nincs

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**        | **Funkció, stílusjegyek**       |
| --------------- | ------------------------------- |
| `<BaseLayout>`  | Az oldal vázát biztosítja       |
| `<BaseSpinner>` | Betöltési animáció              |
| `<h1>`          | Köszönetnyilvánítás címe        |
| `<div>`         | Megköszönő üzenet megjelenítése |
| `<button>`      | Visszalépés a főoldalra         |

## **4. Logika és interakciók**
- **Script setup tartalom**: Felhasználói adatok kezelése és navigáció a főoldalra.
- **Eseménykezelés**: Vissza gomb eseményének kezelése.
- **Reaktív adatok**: `bookingType`, `code`.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                |
| ------------------ | -------------------------------------------- |
| **Színek**         | Rózsaszín és szürke háttér                   |
| **Betűtípus**      | Nincs specifikálva                           |
| **Reszponzivitás** | Mobilbarát elrendezés                        |
| **Effektek**       | Átmenetek a gombokon és háttér homályosítása |

## **A komponens tartalmi összefoglalója**
A komponens célja, hogy **megköszönje a felhasználónak / vendégnek** a foglalást vagy vásárlást, és lehetőséget biztosítson a foglalási információk megtekintésére, valamint a főoldalra való visszalépésre.