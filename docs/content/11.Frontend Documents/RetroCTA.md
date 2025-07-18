# RetroCTA – 'Promóciós' Komponens részletes dokumentáció
---

## 1. **Oldal áttekintése**

A **RetroCTA.vue** komponens egy figyelemfelkeltő, úgynevezett „***call-to-action***” (CTA) szekció, melynek célja, hogy a Cinema Road weboldal látogatóit a **jegyvásárlás** vagy az aktuális **heti vetítések** megtekintése **felé irányítsa**.  
A felhasználó egy modern, „retro autósmozi” hangulatra utaló, letisztult vizuális élményt kap, ahol a fő szlogen és leírás dominál, valamint látványos gombok segítik a navigációt, erősítve az oldal fő célját: látogatókat motiválni az aktív részvételre.

**<u>Felhasználói működés, élmény:</u>**
- Az oldalra érkezéskor egy színes, váltakozó színvilágú szlogen, leírás és két akciógomb fogadja a látogatót.
- A fő képen (autósmozi hangulat) átfedő információs sáv jelenik meg randiötlettel, amely linkel a heti filmekhez.
- Mindent mobilra és asztali nézetre is optimalizált elrendezésben láthatunk.

---

## 2. **Beépített/külső csomagok, hivatkozások**

| **Csomag/hivatkozás**     | **Típus**     | **Forrás / URL**                                                          | **Felhasználás célja, szerepe**                         |
|---------------------------|---------------|---------------------------------------------------------------------------|---------------------------------------------------------|
| Vue Router                | JS plugin     | Projekt része (npm csomag)                                                | Navigáció (router-link komponensek)                     |
| TailwindCSS               | CSS framework | [`https://tailwindcss.com`](https://tailwindcss.com)                       | Reszponzív, gyors, utility-first stílus kezelés         |
| Google Fonts – Cookie     | Betűtípus     | [`https://fonts.google.com/specimen/Cookie`](https://fonts.google.com/specimen/Cookie) | Dekoratív fejlécek, logók                               |
| Google Fonts – Noto Serif | Betűtípus     | [`https://fonts.google.com/specimen/Noto+Serif`](https://fonts.google.com/specimen/Noto+Serif) | Menü, tartalom betűtípus                                |
| Saját képek               | Asset         | `src/assets/img/cinema.png`                                                | Kiemelt kép (autósmozi hangulat)                        |
---

## 3. **Oldal szerkezeti elemei**

| **Elem**                      | **Funkció, tartalom, főbb stílusjegyek**                                                                             |
|-------------------------------|----------------------------------------------------------------------------------------------------------------------|
| `<div class="container ...">` | Fő konténer, maximális szélesség, középre igazítás, padding, különböző breakpointhoz igazodó belső margók           |
| `<div class="grid ...">`      | Rácsszerkezet: 1/2 oszlop elrendezés, nagy felbontáson szétválasztva a szöveget és a képet                          |
| `<h2>`                        | Szlogen: kiemelt, gradients szöveg, nagy betűméret, színes highlight, több sorba törve                              |
| `<div class="bg-gradient...">`| Elválasztó csíkok: pink gradient, különböző vastagság, layout pazar elválasztás                                      |
| `<p>`                         | Kiemelt leírás szöveg, világos színnel, közepes/nagy betűmérettel, középre igazítva                                 |
| `<div class="grid grid-cols...| CTA gombok tárolója: két oszlopos vagy flexbox-elrendezéssel rendezi asztali/mobilon                                 |
| `<router-link to="/tickets">` | Gomb: Jegyvásárlás (pink gradient, árnyék, hover effektek, nagy betű, lekerekített, reszponzív méretezés)            |
| `<router-link to="/movies">`  | Gomb: Heti vetítések (sötétszürke háttér, hover világosítás, lekerekített, szegély, árnyék, reszponzív méretezés)    |
| `<img ...>`                   | Főkép: src/assets/img/cinema.png, fix és változó magasság különböző méretben, object-cover                          |
| `<div class="absolute ...">`  | Overlay sáv a képen: alsó sáv információval, átlátszó fekete háttér, blur, border                                   |
| `<router-link to="/movies/movie">` | Az overlay sávban „Randi ötlet keresel?” marketing szöveggel, pink link a heti mozihoz                        |

---

## 4. **Funkciók, logika, interakciók**

- **Felhasználói interakciók:**
  - **Navigáció:** A két fő CTA gombra kattintva az oldal átirányít `/tickets` (jegyvásárlás) vagy `/movies` (heti vetítések) nézetre.
  - **Overlay link:** Az alsó overlay sávban szintén navigációs link található, amely a heti film részletekhez visz.
  - **Hover effektek:** Gombok és linkek színe, árnyéka, animációja változik egérrel való rámutatáskor.
  - **Reszponzív elrendezés:** Mobilon/minden felbontáson igazodik a tartalom elrendezése.

- **Script/setup kapcsolat:**  
  A komponens nem tartalmaz különálló `<script setup>` vagy logikát, csak deklaratív, template-alapú működést használ (statikus CTA, navigáció csak Vue Routeren keresztül történik).

---

## 5. **Stílus, betűtípusok, reszponzivitás, effektek**

| **Szempont**        | **Részletezés**                                                                                                    |
|---------------------|-------------------------------------------------------------------------------------------------------------------|
| **Színek**          | Háttér: `slate-950`/`slate-900`, Szöveg: `white`, CTA cím highlight: `pink-400`, CTA gombok: pink gradient, leírás: `slate-300` |
| **Betűtípus**       | Google Fonts: Noto Serif (tartalom), Cookie (szlogen), fallback: Arial, sans-serif                                |
| **Reszponzivitás**  | Tailwind breakpoints (`md`, `lg`, `xl`): grid oszlopok, padding, elrendezés, gombméretek, szövegméret és elhelyezkedés |
| **Effektek**        | Hover színezés, fokozott árnyék, smooth transform, skálázás (`hover:scale-105`, `hover:shadow-xl`), lekerekített, overlay-blur |
| **Import**          | Központi (main.ts / main.css): `tailwindcss`, Google Fonts; komponens asset: `src/assets/img/cinema.png`           |

**Példák:**
- Gomb: `bg-gradient-to-r from-pink-600 to-pink-800 hover:from-pink-700 hover:to-pink-900`
- Overlay: `bg-black/60 backdrop-blur-sm rounded-lg`, `shadow-lg`, `transition-all duration-300`

---

### <u>Összegzés:</u>
A RetroCTA.vue komponens egy vizuálisan hangsúlyos szekció, amely hűen képviseli a CinemaRoad weboldal design- és interakciós irányelveit: erőteljes színek, átlátható reszponzív elrendezés, azonnali CTA-kkal. Frontend szempontból minden elem Tailwind utility classokkal épül fel, nincs bonyolult programlogika, kizárólag navigációs interakciók, valamint látványos, minden eszközre optimalizált felhasználói élmény.

---