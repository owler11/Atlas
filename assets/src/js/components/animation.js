/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Number Animation
--------------------------------------------------------------*/

// 1.0 - Number Animation
export function statNumberAnimation() {
  const statNumbers = document.querySelectorAll(".js-stat-number");

  // Options for the IntersectionObserver
  const options = {
    threshold: 0, // Trigger the callback as soon as even one pixel is visible
    rootMargin: "0px 0px -100px 0px", // Trigger 100px before the element comes into view
  };

  // Create a new IntersectionObserver
  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const number = entry.target;
        const rawNumber = number.dataset.number || "0"; // Default to '0' if missing
        const rawDuration = number.dataset.duration || "1000"; // Default to '1000ms' if missing

        // Parse and validate the number and duration
        const endNumber = parseFloat(rawNumber.replace(/,/g, ""));
        const duration = parseInt(rawDuration);

        if (isNaN(endNumber) || isNaN(duration)) {
          console.error(`Invalid data attributes for element:`, number);
          return; // Skip this element if the data is invalid
        }

        const increment = endNumber / (duration / 10);
        let currentNumber = 0;

        // Set an interval to update the number
        const interval = setInterval(() => {
          if (
            (endNumber > 0 && currentNumber >= endNumber) ||
            (endNumber < 0 && currentNumber <= endNumber)
          ) {
            clearInterval(interval);
            number.textContent = endNumber.toLocaleString();
          } else {
            currentNumber += increment;
            number.textContent = (
              endNumber % 1 === 0
                ? Math.round(currentNumber)
                : currentNumber.toFixed(1)
            ).toLocaleString();
          }
        }, 10);

        obs.unobserve(entry.target); // Stop observing the element
      }
    });
  }, options);

  // Observe each stat number element
  statNumbers.forEach((statNumber) => {
    observer.observe(statNumber);
  });
}
