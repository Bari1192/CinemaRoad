# **Base Header (fejléc) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A Cinema Road navigációs sávját biztosítja, amely kapcsolódási lehetőségeket kínál a felhasználóknak a különböző film- és helyszínválasztó, aktív foglalások, bejelentkezési felülethez, oldalakhoz.

- **Fő felhasználói interakciók**:
  - Navigálás a különböző filmekhez
  - Jegyfoglalás és vásárlás
  - "Jegyeim" menüpont, bejelentkezett felhasználó esetén
  - Bejelentkezés és kijelentkezés

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `vue`
  - `vue-router`
  - `@stores/UserStore.js`
  - `@stores/DriveInCinemaStore`
  - `@stores/TicketStore`
- **Betűtípusok, CDN-ek**:
  - Google Fonts: Cookie, Noto Sans, Noto Serif, Onest

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**       | **Funkció, stílusjegyek**                            |
| -------------- | ---------------------------------------------------- |
| `<nav>`        | Navigációs sáv a filmekhez és helyszínekhez          |
| `<RouterLink>` | Hiperhivatkozásokat biztosít, a routerrel integrálva |
| `<ul>`         | Navigációs menü elemei                               |
| `<li>`         | A navigációs menü egyes elemei                       |
| `<button>`     | Kijelentkezés funkció meghívása                      |

## **4. Logika és interakciók**
- **Script setup tartalom**:
  - `ref`, `computed`, `onMounted` importálása
  - Működési logikák a felhasználói állapotok és a választható mozik kezelésére
- **Eseménykezelés**:
  - `toggleMenu()` - menü nyitása és zárása
  - `handleLogOut()` - felhasználó kijelentkezése
- **Reaktív adatok**:
  - `userIsLoggedIn` - a felhasználó bejelentkezési állapota

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                 |
| ------------------ | --------------------------------------------- |
| **Színek**         | Háttér: Slate-950, Szöveg: Pink-600           |
| **Betűtípus**      | 'Cookie', 'Noto Sans', 'Noto Serif', 'Onest'  |
| **Reszponzivitás** | Különböző stílusok a mobil és asztali nézetre |
| **Effektek**       | Színátmenetek és háttér-effektek              |

## **Tartalmi összefoglaló**
A komponens célja, hogy a Cinema Road oldalon biztosítson egy navigációs sávot, amely lehetővé teszi a felhasználók számára a filmek és helyszínek közötti gyors és egyszerű navigálást, valamint az aktív jegyek, bejelentkezés és kijelentkezés funkciók biztosítását.
