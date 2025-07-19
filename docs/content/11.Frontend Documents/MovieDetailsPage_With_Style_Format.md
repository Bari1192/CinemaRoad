# 🎬 Cinema Road – Film Bemutató Oldal Dokumentáció

---

## 1. **Oldal áttekintése**

### ℹ️ Áttekintés:
 Ez az oldal egy _látványos, modern filmadatlap_, ahol a "Cinema Road" fő filmjét mutatjuk be. A látogató egyetlen pillantással tájékozódhat minden fontos filmadatról – **cím, kép, év, típus, rendező, szereplők, játékidő**.

**Fő funkciók, kiemelt elemek:**  
- ⭐️ **Részletes filmadatok azonnali áttekintéssel**
- 🏷️ **Hangsúlyos fejlécek, pink kiemelésekkel**
- 💎 **Szép, színezett adatblokk**
- 📱 **Teljes reszponzivitás (mobil/asztali)**

---

## 2. **Beépített/külső csomagok, hivatkozások**

| **Név**                          | **Típus/Forrás**                            | **Szerep/leírás**                           |
| :------------------------------- | :------------------------------------------ | :------------------------------------------ |
| Vue                              | [vuejs.org](https://vuejs.org/)             | 🌟 Komponens-alapú frontend keret            |
| TailwindCSS                      | [tailwindcss.com](https://tailwindcss.com/) | 🎨 Utility-first CSS framework               |
| BaseLayout                       | Saját file                                  | 🧩 Oldal váza (fejléc/lábléc)                |
| Google Fonts: Cookie, Noto Serif | -                                           | 🅰️ Egyedi márkabetűk (nincs explicit import) |
| Unsplash                         | [unsplash.com](https://unsplash.com/)       | 🖼️ Jogtiszta filmkép forrása                 |

## 3. **Oldal szerkezeti elemei**

| **Elem/Komponens**    | **Funkció, tartalom, főbb stílusjegyek**                  |
| :-------------------- | :-------------------------------------------------------- |
| `<BaseLayout>`        | 🧩 Globális oldalváz, minden tartalom ebben jelenik meg    |
| `<div min-h-screen>`  | 📐 Fő tartalom konténer; középre igazítva, sötét alap      |
| `<h1>`                | 🎬 Fő cím: extra nagy, pink, center, márkaazonosító        |
| `<h2>`                | 🏷️ Alcím: Nagy, vastag, pink, margin, center               |
| `<div max-w-md ...>`  | 🗃️ Adatkártya: border, árnyék, gap, oszlopok               |
| `<div flex-shrink-0>` | 🌆 Doboz: kép tartó, lekerekített, árnyék, border          |
| `<img ...>`           | 🖼️ Filmkép (Unsplash), arányos, árnyék, border, fix méret  |
| `<div mt-6 ...>`      | 💬 Film adatok rácsa, minden adat saját színnel, borderrel |
| `<template v-for...`  | ↔️ Érték/pár kiírás: pink label, normál vagy italic érték  |

---

## 4. **Funkciók, logika, interakciók**

> **📊 Interaktivitás összefoglaló:**  
> Jelen oldalon **nincs** gomb, kereső vagy interaktív funkció, csak adatmegjelenítés.  
> **Minden információ statikus!**

- `<script setup>`:  
  - **Importál** egy layout komponenst  
  - **Definiál** egy `film` nevű JS objektumot (adatokkal)  
  - **Kötés**: a `film.details`-t v-for-ral (cím–érték párok) rendereli  
  - **Kép**: `draggable="false"` – tilos húzni

---

## 5. **Stílus, betűtípusok, reszponzivitás, effektek**

| **Szempont**     | **Részletezés**                                               |
| :--------------- | :------------------------------------------------------------ |
| 🎨 **Színek**     | Háttér: `slate-950`, szöveg: `white`, kiemelés: `pink-500`    |
| 🅰️ **Betűtípus**  | Cím: Cookie (Google Fonts*), tartalom: Noto Serif/Arial       |
| 📐 **Reszponzív** | Tailwind breakpoints: `md:`, `lg:` több helyen                |
| ✨ **Effektek**   | rounded-lg, shadow-xl, border-t-slate-600, border-r-slate-500 |
| 📦 **Import**     | Nincs explicit CSS vagy import; minden Tailwind utility class |

- **Színek példa**:  
  Címsor, label: `text-pink-500`  
  Érték ('Szereplők'): `text-pink-50`  
  Doboz border: `border-t-slate-600`, `border-r-slate-500/90`

---

> **🎯 Összefoglalás:**  
> A _Cinema Road_ film bemutató oldal célja: modern, sötét, pink kiemelésekkel tűzdelt, reszponzív adatlap, Vue 3 + TailwindCSS segítségével, interaktivitás nélkül.  
> **Fő színpaletta:** sötét háttér + pink kiemelések, minden platformon modern, olvasható végeredmény.