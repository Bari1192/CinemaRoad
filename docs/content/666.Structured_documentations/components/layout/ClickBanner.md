# **ClickBanner *(promóciós)* komponens dokumentációja**

## **1. Komponens áttekintése**
- **Célja és funkciója**: A komponens egy filmajánló slider *(csúszkás)* szekciót valósít meg, amely automatikus váltásokkal és navigációs gombokkal rendelkezik.

- **Fő felhasználói interakciók**:
  - Előző és következő filmek közötti navigálás.
  - Film kiválasztása a mozifilmről megjelenő képre való kattintással.
  - Automatikus lejátszás a filmek között.

## **2. Külső függőségek**
- **Importok, csomagok**:
  - `ref`, `onMounted`, `onUnmounted`, `computed` a Vue-ból
  - `storage` a helyi HTTP segédprogramból
- **Betűtípusok, CDN-ek**:
  - [Google Fonts](https://fonts.googleapis.com/css2?family=Cookie&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Onest:wght@100..900&display=swap)

## **3. Strukturális elemek**
**Táblázat minden HTML/Vue elemről:**

| **Elem**                            | **Funkció, stílusjegyek**                        |
| ----------------------------------- | ------------------------------------------------ |
| `<router-link>`                     | Navigál a filmes oldalra                         |
| `<div class="carousel-container">`  | Tartalmazza a karusszelt, kezelve az animációkat |
| `<div v-for="(movie, index)"`       | Dinamikus filmek megjelenítése                   |
| `<img>`                             | Film borítók képének megjelenítése               |
| `<button>`                          | Előző és következő gombok a navigációhoz         |
| `<div class="carousel-indicators">` | Indikátor gombok a diák közötti navigáláshoz     |

## **4. Logika és interakciók**
- **Script setup tartalom**: Az összes belső állapot és függvény definiálva van, beleértve az automatikus lejátszást és a navigálás logikáját.
- **Eseménykezelés**: `handlePrevClick`, `handleNextClick`, `goToSlide` eseménykezelők a gombokhoz.
- **Reaktív adatok**: `movies`, `activeIndex`, `autoplayInterval`, `direction`, és kapcsolódó computed tulajdonságok.

## **5. Stílus összefoglaló**
**Táblázat:**

| **Kategória**      | **Részletek**                                |
| ------------------ | -------------------------------------------- |
| **Színek**         | Szürke, fekete, fehér, rózsaszín             |
| **Betűtípus**      | 'Noto Sans', 'Cookie', 'Onest'               |
| **Reszponzivitás** | Alapértelmezett mobil- és asztali elrendezés |
| **Effektek**       | Áttűnés és animációk a karusszel váltáskor   |

## **Tartalmi összefoglaló**
A komponens célja, hogy bemutassa a legújabb filmeket egy interaktív karusszel formájában, lehetővé téve a felhasználók számára, hogy a filmek között navigáljanak és automatizált átmeneteket tapasztaljanak.
