/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Tab Toggle
--------------------------------------------------------------*/

// 1.0 - Tab Toggle
/**
 *
 * Description:
 * This function enables tab functionality for elements with specific class names.
 * When a target element is clicked, it toggles the 'active' class on both the target and the corresponding source element.
 *
 * Usage:
 * 1. Ensure your HTML structure includes elements with the following classes:
 *    - `.js-tab-parent`: The parent container for the tab elements.
 *    - `.js-tab-source`: The elements that will be shown or hidden based on the tab selection.
 *    - `.js-tab-target`: The clickable elements that trigger the tab functionality.
 *
 *
 * Example HTML Structure:
 * <div class="js-tab-parent">
 *     <div class="js-tab-target">Tab 1</div>
 *     <div class="js-tab-target">Tab 2</div>
 *     <div class="js-tab-target">Tab 3</div>
 *
 *     <div class="js-tab-source">Content 1</div>
 *     <div class="js-tab-source">Content 2</div>
 *     <div class="js-tab-source">Content 3</div>
 * </div>
 *
 */
export function tabToggle() {
  const tabParent = document.querySelectorAll(".js-tab-parent");

  if (tabParent) {
    tabParent.forEach((tab) => {
      const tabSource = tab.querySelectorAll(".js-tab-source");
      const tabTarget = tab.querySelectorAll(".js-tab-target");

      tabTarget.forEach((target, index) => {
        target.addEventListener("click", () => {
          // Remove 'active' class from all tabContent elements
          tabTarget.forEach((targetItem) =>
            targetItem.classList.remove("active"),
          );

          // Add 'active' class to the corresponding tabContent element
          target.classList.add("active");

          // Remove 'active' class from all tabMedia elements
          tabSource.forEach((source, sourceIndex) => {
            source.classList.remove("active");

            // if mediaIndex is equal to the index of the clicked tabContent element, add 'active' class to the corresponding tabMedia element
            if (sourceIndex === index) {
              tabSource[sourceIndex].classList.add("active");
            }
          });
        });
      });
    });
  }
}
