/*--------------------------------------------------------------
 TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Mobile menu (drawer)
  1.1 - Close menu
  1.2 - Open menu
  1.3 - Handle resize
  1.4 - Menu toggle
2.0 - Primary menu submenus
--------------------------------------------------------------*/

// 1.0 - Mobile menu (drawer)
export function mobileMenu() {
  const siteHeader = document.querySelector(".site-header");
  if (!siteHeader) return;

  const toggle = siteHeader.querySelector(".js-menu-toggle");
  const backdrop = document.querySelector(".site-backdrop");

  // 1.1 - Close menu
  function closeMenu() {
    // Remove menu-open class and body-lock class
    siteHeader.classList.remove("menu-open");
    document.body.classList.remove("body-lock");

    // Set aria-expanded and aria-label
    if (toggle) {
      toggle.setAttribute("aria-expanded", "false");
      toggle.setAttribute("aria-label", "Open menu");
    }

    // Reset all open submenus (accordion state + tabindex)
    siteHeader.querySelectorAll(".primary-menu__item--has-dropdown.is-open").forEach((dropdownItem) => {
      dropdownItem.classList.remove("is-open");
      
      // Reset trigger and submenu
      const triggerEl = dropdownItem.querySelector(".primary-menu__trigger");
      const submenuEl = dropdownItem.querySelector(".primary-menu__submenu");
      
      if (triggerEl) triggerEl.setAttribute("aria-expanded", "false");
      
      if (submenuEl) {
        submenuEl.querySelectorAll(".primary-menu__link").forEach((link) => link.setAttribute("tabindex", "-1"));
      }
    });
  }

  // 1.2 - Open menu
  function openMenu() {
    // Set header height
    const headerBottom = siteHeader.getBoundingClientRect().bottom;
    document.documentElement.style.setProperty("--header-height", `${headerBottom}px`);

    // Open menu
    siteHeader.classList.add("menu-open");
    document.body.classList.add("body-lock");

    // Set aria-expanded and aria-label
    if (toggle) {
      toggle.setAttribute("aria-expanded", "true");
      toggle.setAttribute("aria-label", esc_attr__("Close menu", "atlas"));
    }
  }

  // 1.3 - Close on resize
  let resizeTimer; // Debounce timer for resize event
  
  function onResize() {
    if (window.innerWidth >= 1024) closeMenu();
  }

  onResize();

  window.addEventListener("resize", () => {
    document.body.classList.add("no-animate");
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      document.body.classList.remove("no-animate");
      onResize();
    }, 200);
  });

  // 1.4 - Menu toggle
  if (toggle) {
    toggle.addEventListener("click", () => {
      if (siteHeader.classList.contains("menu-open")) closeMenu();
      else openMenu();
    });
  }

  // 1.5 - Other close / closeMenu events
  // Close if backdrop is clicked
  if (backdrop) backdrop.addEventListener("click", closeMenu);

  // Close if clicked outside the menu
  document.addEventListener("click", (event) => {
    const isDrawerOpen = siteHeader.classList.contains("menu-open");
    const clickedOutside = !event.target.closest(".site-header__menu") && !event.target.closest(".js-menu-toggle");
    if (isDrawerOpen && clickedOutside) closeMenu();
  });

  // Close if Escape is pressed
  document.addEventListener("keydown", (e) => {
    if (e.key !== "Escape" || !siteHeader.classList.contains("menu-open")) return;
    e.preventDefault();
    closeMenu();
    if (toggle) toggle.focus();
  });
}



// 2.0 - Primary menu submenus
/* Notes:
 * accordion on mobile (drawer)
 * dropdown on desktop (hover or .is-open)
 * one .is-open state (for both)
*/  
export function primaryMenuSubmenus() {
  const list = document.querySelector(".primary-menu__list");
  if (!list) return;

  // Get all dropdown items
  const dropdownItems = list.querySelectorAll(".primary-menu__item--has-dropdown");

  dropdownItems.forEach((item) => {
    // Get the trigger button, link, and submenu
    const trigger = item.querySelector(":scope > .primary-menu__trigger");
    const link = item.querySelector(":scope > .primary-menu__link");
    const submenu = item.querySelector(":scope > .primary-menu__submenu");
    if (!trigger || !submenu) return;

    // Get all direct child links
    const directLinks = submenu.querySelectorAll(":scope > .primary-menu__item > .primary-menu__link");
    const firstLink = directLinks[0]; // Get the first link
    directLinks.forEach((el) => el.setAttribute("tabindex", "-1")); // Set all direct child links to tabindex="-1"

    // Open the dropdown
    function open(focusFirst = false) {
      item.classList.add("is-open");
      trigger.setAttribute("aria-expanded", "true");
      directLinks.forEach((el) => el.setAttribute("tabindex", "0"));
      if (focusFirst && firstLink) firstLink.focus();
    }

    // Close the dropdown
    function close() {
      item.classList.remove("is-open");
      trigger.setAttribute("aria-expanded", "false");
      directLinks.forEach((el) => el.setAttribute("tabindex", "-1"));
    }

    // Toggle the dropdown
    function toggleOpen() {
      if (item.classList.contains("is-open")) close();
      else open();
    }

/* 
 * Event listeners for the trigger button
 * 
 * Click: toggle the dropdown
 * Keyboard: open or close the dropdown
 * Parent link: open the dropdown
 * Submenu links: Escape closes and returns focus to trigger
 * Desktop: close when focus leaves the dropdown
 * 
 */

    // Click
    trigger.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      toggleOpen();
    });

    // Keyboard (Enter/Space open or close; ArrowDown open; Escape close)
    trigger.addEventListener("keydown", (e) => {
      if (e.key === "Enter" || e.key === " ") {
        e.preventDefault();
        if (item.classList.contains("is-open")) close();
        else open(true);
        return;
      }
      if (e.key === "ArrowDown") {
        e.preventDefault();
        open(true);
      } else if (e.key === "Escape") {
        e.preventDefault();
        close();
        trigger.focus();
      }
    });

    // Parent link: ArrowDown opens submenu
    if (link) {
      link.addEventListener("keydown", (e) => {
        if (e.key === "ArrowDown") {
          e.preventDefault();
          open(true);
        }
      });
    }

    // Submenu links: Escape closes and returns focus to trigger
    directLinks.forEach((submenuLink) => {
      submenuLink.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
          e.preventDefault();
          close();
          trigger.focus();
        }
      });
    });

    // Desktop: close when focus leaves the dropdown
    item.addEventListener("focusout", (e) => {
      if (!item.contains(e.relatedTarget)) close();
    });
  });

  // Desktop: close all dropdowns when clicking outside the menu
  document.addEventListener("click", (e) => {
    if (e.target.closest(".primary-menu__list")) return;
    dropdownItems.forEach((item) => {
      const trigger = item.querySelector(":scope > .primary-menu__trigger");
      const submenu = item.querySelector(":scope > .primary-menu__submenu");
      if (trigger && submenu && item.classList.contains("is-open")) {
        item.classList.remove("is-open");
        trigger.setAttribute("aria-expanded", "false");
        submenu.querySelectorAll(".primary-menu__link").forEach((el) => el.setAttribute("tabindex", "-1"));
      }
    });
  });
}
