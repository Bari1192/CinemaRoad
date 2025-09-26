# **Base Footer (lábléc) komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: Az alábbi Vue komponens egy láblécet *(footer-t)* definiál, amely a Cinema Road mozi weboldalra készült és a BaseLayout szerver részét képzi. Információkat tartalmaz a mozi elérhetőségeiről, gyorslinkeket és közösségi média hivatkozásokat az oldallal kapcsolatosan.

- **Fő felhasználói interakciók**:
  - Navigálás a főoldalra, premier filmekre, jegyvásárlásra, helyszínekre, bejelentkezésre és regisztrációra.
  - Közösségi média platformok követése / megtekintési, átirányítási lehetőségek.

## **2. Külső függőségek**
- **Importok, csomagok**: `ref` a Vue-ból.
- **Betűtípusok, CDN-ek**: Font Awesome ikonok és Google Fonts.

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**   | **Funkció, stílusjegyek**                                                |
| ---------- | ------------------------------------------------------------------------ |
| `<footer>` | Az oldal láblécét definiálja, szürke háttérrel.                          |
| `<h3>`     | Mozi neve, nagy méretű, pink színű, dőlt, középre igazított.             |
| `<p>`      | Leíró szöveg a drive-in moziról, dőlt és italizált.                      |
| `<h4>`     | Szakaszcímek a linkek és elérhetőségek számára, fehér színű és félkövér. |
| `<ul>`     | Lista a gyorslinkekhez, rácsos elrendezéssel.                            |
| `<li>`     | Listás elemek a navigációs hivatkozásokhoz.                              |
| `<p>`      | Elérhetőségek, ikonokkal kiegészítve.                                    |
| `<div>`    | Közösségi média linkek, ikonokkal.                                       |
| `<div>`    | Átmeneti elválasztó és jogi szöveg az alján.                             |

## **4. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                                                          |
| ------------------ | -------------------------------------------------------------------------------------- |
| **Színek**         | Szürke háttér, pink és fehér betűszín, kék, vörös és rózsaszín közösségi média ikonok. |
| **Betűtípus**      | Cookie, Noto Sans, Noto Serif, Onest.                                                  |
| **Reszponzivitás** | Rácsos elrendezés, amely alkalmazkodik a képernyőmérethez.                             |
| **Effektek**       | Betűszín változás az egérrel való áttételkor.                                          |

## **Tartalmi összefoglaló**
A komponens célja egy informatív lábléc létrehozása a Cinema Road mozi weboldalon, amely magában foglalja a mozi nevét, elérhetőségeit, gyorslinkeket és közösségi média hivatkozásokat.
