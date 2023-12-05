   // Delay time in milliseconds (e.g., 3000 for 3 seconds)
   var preloaderDelay = 300;

// Function to hide the preloader and show the content
function hidePreloaderAndShowContent() {
    var preloader = document.getElementById('preloader');
    var contentWrapper = document.getElementById('content-wrapper');

    // Hide the preloader
    preloader.style.display = 'none';

    // Show the content
    contentWrapper.style.display = 'block';
}

// Set a timeout to hide the preloader and show content after the delay
setTimeout(hidePreloaderAndShowContent, preloaderDelay);