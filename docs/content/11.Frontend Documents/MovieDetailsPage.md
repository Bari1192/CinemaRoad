# Cinema Road – Film Bemutató Oldal *(template)* Dokumentáció
---

## 1. **Oldal áttekintése**

Az oldal egy film bemutató oldalát jeleníti meg a "Cinema Road" webalkalmazásban. A felhasználó egy adott film részletes adatlapját láthatja, ahol a fő hangsúly vizuálisan kiemelt címeken, nagy méretű borítóképen és a film legfontosabb információin van. A szerkezet letisztult és jól áttekinthető: a cím és kép mellett jól láthatóak a film adatai (készítési év, típus, rendező, játékidő), szereplői listája, valamint rövid tartalmi leírása.

Az oldal mobil és asztali nézeten is megfelelően jelenik meg, köszönhetően a TailwindCSS osztályok által biztosított reszponzivitásnak. A fejlesztés közben kiemelt szempont volt a modern vizuális élmény, a strukturált adatmegjelenítés, valamint a könnyű áttekinthetőség.

**Fő funkciók, elemek:**
- Film adatai (cím, kép, év, típus, rendező, játékidő) megjelenítése
- Kiugró, központi fejléc és alcím
- Nagyméretű, vizuálisan hangsúlyos filmkép
- Táblázatos/rácsos elrendezésű adatkártya (adatcím-érték párok)
- Külön blokkban jelenik meg a szereplőgárda és a rövid leírás
- Reszponzív dizájn mobilra és asztalira optimalizálva

---

## 2. **Beépített/külső csomagok, hivatkozások**

| **Név**       | **Típus/Forrás**                             | **Szerep/leírás**                                   |
|---------------|----------------------------------------------|-----------------------------------------------------|
| Vue           | [`vuejs.org`](https://vuejs.org/)            | Teljes oldal Vue 3 komponensre épül                 |
| TailwindCSS   | [`tailwindcss.com`](https://tailwindcss.com/) | Stílusozás, reszponzivitás, utility class-ek        |
| BaseLayout    | Saját file: `@layouts/BaseLayout.vue`        | Oldal keretszerkezet (fejléc/lábléc)                |
| Google Fonts: Cookie, Noto Serif | (Nincs explicit import) | Betűtípus név szerint említve - tényleges CSS import nem látható  |
| Unsplash      | [https://images.unsplash.com/](https://unsplash.com/) | Film borítókép forrása                              |

**Használat szerepe:**
- **Vue**: Komponens alapú fejlesztés, könnyű karbantartás, átlátható szerkezeti felépítés.
- **TailwindCSS**: Gyors prototipizálás, egységes stílus, mobil- és desktop támogatás.
- **BaseLayout**: Központi elrendezés és minden oldal közös vázának biztosítása.
- **Google Fonts**: Egyedi, modern betűtípus a vizuális arculat erősítéséhez (feliratok, főcím).
- **Unsplash**: Jogtiszta, nagy felbontású borítóképek forrása a filmekhez.

---

## 3. **Oldal szerkezeti elemei**

| **Elem/Komponens**                        | **Funkció, tartalom, főbb stílusjegyek**                                               |
|--------------------------------------------|----------------------------------------------------------------------------------------|
| `<BaseLayout>`                            | Globális oldalváz, benne helyezkedik el az összes tartalom                             |
| `<div class="min-h-screen ...">`           | Teljes vizuális konténer, amely középre igazítja az elemeket és beállítja a háttérszínt|
| `<h1>`                                    | Főcím: „A Cinema Road Bemutatja” – nagy betű, pink szín, középre igazítva              |
| `<h2>`                                    | Alcím: a film címe/alcíme, szintén nagy, pink, extrabold, középre rendezve             |
| `<div class="w-full max-w-md ...">`        | A film adatainak doboza, rácsos elrendezéssel                                          |
| `<div class="flex-shrink-0 ...">`          | Filmkép doboza: lekerekített sarkok, árnyék, border                                    |
| `<img :src="film.image" ...>`              | A film borítóképe (Unsplash URL, dinamikusan töltve, fix méret, shadow, border)        |
| `<div class="mt-6 md:mt-0 ...">`           | Filmadatok adatrácsa, bal/jobb elosztással, grid layout                                |
| `<template v-for="(detail, idx) in ...">`  | Film adatok (év, típus, rendező, idő) – páronként iterálva, balról cím, jobbról érték  |
| `<div class="col-span-1 ...">` (label)     | Adat cím, pink szín, uppercase, border, balra igazítva                                 |
| `<div ...>` (value)                        | Adat érték – rugalmasság, betűméret, fórmázás, bal vagy közép igazítás                 |
| `<div class="...">`                        | „Szereplők” kiemelés/alcím – alcím, underline, pink szín                               |
| `<div ...>`                                | Szereplők értéke: italic, világos rózsaszín, sortörés engedélyezve                    |
| `<div ...">`                               | „Rövidleírás” felirat: ugyanolyan stílus, mint a „Szereplők” alcím                    |
| `<div ...>`                                | A film rövid leírása: világos szín, betűméret, balra igazított, tömbös szöveg          |

---

## 4. **Funkciók, logika, interakciók**

- **Felhasználói interakciók:**  
  - Felhasználói beavatkozást, kattintást, eseménykezelőt NEM tartalmaz az oldal – minden megjelenítés statikus jellegű, csak adatbemutatás van.
  - Kép elemnél a húzás letiltott (`draggable=false`).
  - Gomb, navigációs elem, kereső NINCS integrálva az oldalban.
- **`<script setup>` logika:**  
  - Importálja a közös BaseLayout komponensét.
  - Létrehoz egy `film` nevű konstans objektumot, amely tartalmazza:
    - A kép URL-jét (Unsplash link)
    - A film részleteit (év, típus, rendező, játékidő) tömbösítve
    - A szereplők listáját egy stringben, vesszőkkel elválasztva
    - A film rövid leírását
  - Ezek az adatok sablon feltöltéssel jelennek meg a template (összes detail-t v-for bejárással rendereli).
  - Nincsenek állapotváltoztatók, navigáció, input eseményfigyelők.

---

## 5. **Stílus, betűtípusok, reszponzivitás, effektek**

| **Szempont**        | **Részletezés**                                                        |
|---------------------|------------------------------------------------------------------------|
| **Színek**          | Háttér: `slate-950`, Doboz border: `slate-600`, Szöveg: `white`, Hangsúlyok: `pink-500`/`pink-300` |
| **Betűtípus**       | Főcím: feltételezve Cookie (Google Fonts); szöveg: Noto Serif, fallback Arial  |
| **Reszponzivitás**  | Tailwind breakpoints (`md:`, `lg:`), pl. cím mérete, box elrendezés oszlopba |
| **Effektek**        | `rounded-lg` (lekerekített sarkok), `shadow-xl` (árnyék), `border`, pink color, underline, italic |
| **Import**          | CSS/import explicit nincs a kódban; csak Tailwind utility class-okat használ, betűtípus link nincs  |

**Példák:**
- **Színek**:
  - Főcím: `text-pink-500`
  - Adatcímkék: `text-pink-500`, alsó border: `border-t-slate-600`, jobb border: `border-r-slate-500/90`
  - Szereplők cím: `text-pink-300`; szereplők érték: `text-pink-50`
- **Reszponzív elrendezés:**
  - Kis kijelzőn minden blokk egymás alatt
  - Közepes+ kijelzőn: kép bal oldalt, adatok mellette/hosszabban
  - Cím méretek változnak: pl. `text-2xl md:text-4xl lg:text-5xl`
- **Effektek:**
  - Doboz: `rounded-lg`, `shadow-xl`, `border-2`
  - Border extra vastag jobb szélen: `border-r-4`
  - Szövegvastagság: `font-bold`, `font-medium`, `font-extrabold`
  - Underline: alcímeken, underline-offset
  - Hover/animáció: explicit nincs
- **Import:**  
  - Csak Tailwind CSS utility class-ok – külön CSS vagy font import nincs jelen.

---

**Összefoglalás:**

A Cinema Road film bemutató oldala célja, hogy egy adott film adatlapját esztétikus, letisztult és reszponzív formában jelenítse meg Vue 3 + TailwindCSS segítségével. Az oldal központi eleme a látványos, jól strukturált információmegjelenítés – az adatok forrása lokális objektum, nincs külső adatbetöltés vagy felhasználói interakció. Az arculatot a modern utility class-alapú styling, valamint a gondosan választott betűtípusok és képi elemek adják. Az oldal megfelel a reszponzív kialakítás, a Visual Storytelling és az áttekinthetőség szempontjainak.

---