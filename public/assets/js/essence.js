/* ===========================
   MOBILE NAVIGATION
=========================== */
const hamburger = document.querySelector(".hamburger");
const navMenu = document.querySelector(".nav-menu");

if (hamburger && navMenu) {
    hamburger.addEventListener("click", () => {
        hamburger.classList.toggle("active");
        navMenu.classList.toggle("active");
    });

    document.querySelectorAll(".nav-link").forEach(link =>
        link.addEventListener("click", () => {
            hamburger.classList.remove("active");
            navMenu.classList.remove("active");
        })
    );
}

/* ===========================
   SMOOTH SCROLL
=========================== */
document.querySelectorAll('a[href^="#"]').forEach(link => {
    link.addEventListener("click", e => {
        const target = document.querySelector(link.getAttribute("href"));
        if (!target) return;

        e.preventDefault();
        const offset = target.offsetTop - 80;
        window.scrollTo({ top: offset, behavior: "smooth" });
    });
});

/* ===========================
   NAVBAR SCROLL EFFECT
=========================== */
const navbar = document.querySelector(".navbar");

if (navbar) {
    window.addEventListener("scroll", () => {
        const y = window.scrollY;
        navbar.style.padding = y > 80 ? "14px 0" : "20px 0";
        navbar.style.boxShadow =
            y > 80 ? "0 4px 18px rgba(0,0,0,.08)" : "0 2px 10px rgba(0,0,0,.04)";
    });
}
// ==========================
// AUTO-HIDE NAVBAR (NEW)
// ==========================
let lastScroll = 0;

window.addEventListener("scroll", () => {
    const current = window.scrollY;
    const navbar = document.querySelector(".navbar");
    if (!navbar) return;

if (current > lastScroll && current > 120) {
    navbar.classList.add("hide");
    navbar.classList.remove("show");

    // 🔥 AUTO CLOSE MENU SAAT NAVBAR HIDE
    navMenu?.classList.remove("active");
    hamburger?.classList.remove("active");

} else {
    navbar.classList.add("show");
    navbar.classList.remove("hide");
}


    lastScroll = current;
});

/* ===========================
   PRODUCT HOVER ELEGANCE
=========================== */
document.querySelectorAll(".product-card").forEach(card => {
    const img = card.querySelector(".product-img");
    if (!img) return;

    card.addEventListener("mouseenter", () => {
        img.style.transform = "scale(1.04)";
        img.style.transition = "transform .35s ease";
    });

    card.addEventListener("mouseleave", () => {
        img.style.transform = "scale(1)";
    });
});

/* ===========================
   SCROLL REVEAL — SOFT ENTRY
=========================== */
const observer = new IntersectionObserver(
    entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("reveal");
                observer.unobserve(entry.target);
            }
        });
    },
    { threshold: 0.15 }
);

document.querySelectorAll(".product-card, .section-title").forEach(el =>
    observer.observe(el)
);

// Scroll indicator click → smooth scroll to section
const scrollIndicator = document.querySelector('.scroll-indicator');

if (scrollIndicator) {
    scrollIndicator.addEventListener('click', () => {
        const target = document.querySelector(
            scrollIndicator.getAttribute('data-target')
        );

        if (!target) return;

        const offsetTop = target.offsetTop - 80; // kompensasi navbar
        window.scrollTo({
            top: offsetTop,
            behavior: "smooth"
        });
    });
}
document.addEventListener("DOMContentLoaded", () => {

  const track = document.querySelector("#highlightTrack");
  if (!track) return;

  let cards = [...track.children];

  const VISIBLE = 3;          // jumlah kartu tampak
const STEP_DELAY = 2500; // berhenti 2.5 detik
const SPEED = 650;       // animasi 0.65 detik


  let index = VISIBLE;
  let paused = false;
  let isSnapping = false;
 

  /* ===== CLONE DEPAN & BELAKANG (infinite loop) ===== */
  const head = cards.slice(0, VISIBLE).map(n => n.cloneNode(true));
  const tail = cards.slice(-VISIBLE).map(n => n.cloneNode(true));

  head.forEach(n => n.dataset.clone = "head");
  tail.forEach(n => n.dataset.clone = "tail");

  tail.forEach(n => track.insertBefore(n, cards[0]));
  head.forEach(n => track.appendChild(n));

  cards = [...track.children];

  /* ===== POSITIONING ===== */
function goTo(i, animated = true){
  if(!cards[i]) return; // 🔥 anti undefined
  const x = cards[i].offsetLeft;
  track.style.transition = animated ? `${SPEED}ms ease` : "none";
  track.style.transform = `translateX(-${x}px)`;
}


  function normalize(i){
    if(cards[i]?.dataset.clone === "head") return VISIBLE;
    if(cards[i]?.dataset.clone === "tail") return cards.length - (VISIBLE * 2 + 1);
    return i;
  }

  function init(){
    if(!cards[index] || cards[index].offsetWidth === 0)
      return requestAnimationFrame(init);

    goTo(index,false);
  }
  requestAnimationFrame(init);

  window.addEventListener("load", () => {
    goTo(index, false);
  });

  if (document.fonts && document.fonts.ready) {
    document.fonts.ready.then(() => {
      goTo(index, false);
    });
  }

  window.addEventListener("resize", () => {
    goTo(index, false);
  });


  /* ===== AUTOPLAY ===== */
/* ===== AUTOPLAY (PAUSE PER PRODUK) ===== */
let autoplayTimeout = null;

function scheduleNext(){
  clearTimeout(autoplayTimeout);

  autoplayTimeout = setTimeout(() => {
    if(paused || isSnapping) return scheduleNext();

    // geser ke next
    index++;
    goTo(index, true);

    // setelah animasi selesai, normalize kalau clone
    setTimeout(() => {
      if(cards[index]?.dataset.clone){
        index = normalize(index);
        goTo(index, false);
      }

      // lanjutkan autoplay lagi (pause -> slide -> pause -> slide)
      scheduleNext();

    }, SPEED + 50);

  }, STEP_DELAY); // ini durasi berhenti per produk
}

scheduleNext();

track.addEventListener("transitionend", (e) => {
  if(e.propertyName !== "transform") return;
  if(isSnapping) return;

  if(cards[index]?.dataset.clone){
    index = normalize(index);
    goTo(index,false);
  }
});


  /* ===== PAUSE & SNAP ON USER ACTION ===== */
  function pauseAndSnap(){
    if(isSnapping) return; 
    paused = true;
    isSnapping = true;

    let nearest = 0, min = Infinity;
    const t = parseFloat(track.style.transform.replace(/[^-0-9.]/g,"")) || 0;

    cards.forEach((c,i)=>{
      const d = Math.abs(t + c.offsetLeft);
      if(d < min){ min = d; nearest = i; }
    });

    index = nearest;
    goTo(index,true);

setTimeout(()=>{
  index = normalize(index);
  goTo(index,false);
  isSnapping = false;
  paused = false;
  scheduleNext(); // ✅ lanjut autoplay lagi
}, 600);

  }

  /* ===== DRAG & WHEEL STEP ===== */
  let startX = 0, dragSum = 0;
  const THRESH = 90;

  function step(dir){
    index += dir;
    goTo(index,true);
  }

  // mouse
  track.addEventListener("mousedown", e=>{
    startX = e.clientX; dragSum = 0; pauseAndSnap();
  });
  track.addEventListener("mousemove", e=>{
    if(e.buttons !== 1) return;
    const dx = e.clientX - startX;
    startX = e.clientX;
    dragSum += dx;
    if(dragSum < -THRESH){ step(1); dragSum=0; }
    if(dragSum >  THRESH){ step(-1); dragSum=0; }
  });

  // touch
  track.addEventListener("touchstart", e=>{
    startX = e.touches[0].clientX; dragSum = 0; pauseAndSnap();
  });
  track.addEventListener("touchmove", e=>{
    const dx = e.touches[0].clientX - startX;
    startX = e.touches[0].clientX;
    dragSum += dx;
    if(dragSum < -THRESH){ step(1); dragSum=0; }
    if(dragSum >  THRESH){ step(-1); dragSum=0; }
  });

  // wheel
track.addEventListener("wheel", (e) => {
  // hanya jalan kalau user benar-benar scroll di area slider
  e.preventDefault();

  pauseAndSnap();
  step(e.deltaY > 0 ? 1 : -1);
}, { passive: false });


});
