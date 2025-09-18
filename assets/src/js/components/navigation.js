/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - ADA Walker
2.0 - Mobile Menu
3.0 - Menu Children
4.0 - Drilldown
5.0 - Search
--------------------------------------------------------------*/

const siteHeader = document.querySelector(".site-header");

// 1.0 - ADA Walker
export function menuWalker() {
  //ADA Compliance roles
  jQuery(".menu-primary .sub-menu").attr("role", "menubar");
  jQuery(".menu-primary li").attr("role", "menuitem");
  jQuery(".utility-menu li").attr("role", "menuitem");

  jQuery(function ($) {
    // Focus styles for menus when using keyboard navigation
    // Properly update the ARIA states on focus (keyboard) and mouse over events
    $('[role="menubar"]').on(
      "focus.aria  mouseenter.aria",
      '[aria-haspopup="true"]',
      function (ev) {
        $(ev.currentTarget).attr("aria-expanded", true);
      },
    );

    // Properly update the ARIA states on blur (keyboard) and mouse out events
    $('[role="menubar"]').on(
      "blur.aria  mouseleave.aria",
      '[aria-haspopup="true"]',
      function (ev) {
        $(ev.currentTarget).attr("aria-expanded", false);
      },
    );
  });
}

// 2.0 - Mobile Menu
export function mobileMenu() {
  const burger = document.querySelector(".js-menu-toggle");
  const closeMenu = document.querySelector(".js-menu-close");

  let resizeTimer;

  // Check window width and remove classes if needed
  function checkWindowWidth() {
    if (window.innerWidth >= 1022) {
      if (siteHeader.classList.contains("menu-open")) {
        siteHeader.classList.remove("menu-open");
      }
      if (document.body.classList.contains("body-lock")) {
        document.body.classList.remove("body-lock");
      }
    }
  }

  // Check on load
  checkWindowWidth();

  // eslint-disable-next-line
  window.addEventListener("resize", () => {
    document.body.classList.add("no-animate");

    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
      document.body.classList.remove("no-animate");
      checkWindowWidth(); // Check window width after resize
    }, 200);
  });

  if (burger) {
    // eslint-disable-next-line
    document.addEventListener("click", function (event) {
      // Toggle menu when clicking on the burger
      if (event.target.closest(".js-menu-toggle")) {
        siteHeader.classList.toggle("menu-open");
      }
      // Close menu when clicking outside of the menu item
      else if (
        siteHeader.classList.contains("menu-open") &&
        !event.target.closest(".site-header__primary-menu")
      ) {
        siteHeader.classList.remove("menu-open");
      }

      // Lock body
      if (siteHeader.classList.contains("menu-open")) {
        document.body.classList.add("body-lock");
      } else {
        document.body.classList.remove("body-lock");
      }
    });
  }

  if (closeMenu) {
    closeMenu.addEventListener("click", function (event) {
      event.stopPropagation();
      siteHeader.classList.remove("menu-open");
      document.body.classList.remove("body-lock");
    });
  }
}

// 3.0 - Menu Children
export function menuChildrenToggle() {
  const menuHasChildren = document.querySelectorAll(".menu-item-has-children");
  const menuPrimary = document.querySelector(".menu-primary");

  menuHasChildren.forEach(function (menu) {
    const menuLink = menu.querySelector("a");
    const createdDiv = document.createElement("div");
    createdDiv.classList.add("menu-item-arrow");

    if (menuPrimary && menuPrimary.classList.contains("vertical-drilldown")) {
      menuLink.append(createdDiv);
    } else {
      menu.append(createdDiv);
    }

    // Add event listener to menuLink
    if (menuPrimary && menuPrimary.classList.contains("vertical-drilldown")) {
      menuLink.addEventListener("click", function (event) {
        event.stopImmediatePropagation();
        event.preventDefault(); // Prevent the default action
        setActive(menu); // Call your setActive function
      });
    }

    createdDiv.addEventListener("pointerdown", function () {
      setActive(menu);
    });
  });

  const setActive = (el) => {
    const result = el.classList.contains("is-active");

    if (result) {
      [...el.parentElement.children].forEach((sib) =>
        sib.classList.remove("is-active"),
      );
    } else {
      [...el.parentElement.children].forEach((sib) =>
        sib.classList.remove("is-active"),
      );

      el.classList.add("is-active");
    }
  };
}

// 4.0 - Drilldown
export function menuDrilldown() {
  const subMenu = siteHeader.querySelectorAll(".sub-menu");

  if (siteHeader.classList.contains("type-vertical-drilldown")) {
    subMenu.forEach(function (menu) {
      const createdDiv = document.createElement("button");
      createdDiv.classList.add("menu-item-back");
      createdDiv.innerHTML =
        '<i class="fa-solid fa-angle-left icon-back"></i> Back';
      menu.prepend(createdDiv);

      createdDiv.addEventListener("click", function (event) {
        event.stopImmediatePropagation();
        event.preventDefault();
        setActive(menu);
      });
    });

    const setActive = (el) => {
      const parentLi = el.closest("li"); // Find the closest parent li element
      const isActive = parentLi.classList.contains("is-active");

      // If the element is active, deactivate all siblings
      if (isActive) {
        parentLi.classList.remove("is-active");
      }
    };
  }

  // Find the maximum height of all .sub-menu elements inside .menu-primary
  let maxHeight = 0;
  subMenu.forEach(function (menu) {
    const menuHeight = menu.offsetHeight;
    if (menuHeight > maxHeight) {
      maxHeight = menuHeight;
    }
  });

  // Set the maximum height as the min-height of .menu-wrapper
  const menuWrapper = document.querySelector(".menu-wrapper");
  if (siteHeader.classList.contains("type-vertical-drilldown") && menuWrapper) {
    menuWrapper.style.minHeight = `${maxHeight}px`;
  }

  // if I click outside of .site-header__primary-menu, can you remove .menu-open from siteHeader and remove all .is-active from .menu-item-has-children
  // eslint-disable-next-line
  document.addEventListener("click", function (event) {
    event.stopPropagation();
    if (
      !event.target.closest(".site-header__primary-menu") &&
      siteHeader.classList.contains("menu-open")
    ) {
      document
        .querySelectorAll(".menu-item-has-children")
        .forEach(function (menu) {
          menu.classList.remove("is-active");
        });
    }
  });
}

// 5.0 - Search
export function searchToggle() {
  const searchButton = document.querySelector(".js-search-toggle");
  const searchForm = document.querySelector(".site-header__search-form");

  if (searchButton) {
    searchButton.addEventListener("click", function (event) {
      siteHeader.classList.toggle("search-open");
      event.stopPropagation();
    });

    // eslint-disable-next-line
    document.addEventListener("click", function (event) {
      if (
        searchForm &&
        !searchForm.contains(event.target) &&
        !searchButton.contains(event.target) &&
        siteHeader.classList.contains("search-open")
      ) {
        siteHeader.classList.remove("search-open");
      }
    });
  }
}
