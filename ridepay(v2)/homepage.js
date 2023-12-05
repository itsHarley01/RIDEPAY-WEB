const itemssbElements = document.querySelectorAll('.itemssb');
    const iframe = document.getElementById('iframe');
    const menuToggle = document.getElementById("menu-toggle");
    const subMenu = document.getElementById("sub-menu");
    const menuIcon = document.getElementById('toggle-icon');

    // Function to load a page in the iframe
    function loadPage(page) {
        iframe.src = page + '.php';
    }

    // Function to handle the 'click' event on 'itemssb' elements
    function handleItemClick(item) {
        itemssbElements.forEach(item => {
            item.classList.remove('active');
        });

        item.classList.add('active');

        const icon = item.querySelector('i');
        icon.classList.toggle('blue');
    }

    // Add 'click' event listeners to 'itemssb' elements
    itemssbElements.forEach(item => {
        item.addEventListener('click', () => {
            const page = item.querySelector('.side').getAttribute('data-page');
            loadPage(page);
            handleItemClick(item);
        });
    });
    const subMenuItems = document.querySelectorAll('#sub-menu .itemssb');
    
    subMenuItems.forEach(item => {
        item.addEventListener('click', () => {
            const dataPage = item.getAttribute('data-page');
            loadPage(dataPage);
            handleItemClick(item);
        });
    });
    
subMenuItems.forEach(item => {
    item.addEventListener('click', () => {
        handleItemClick(item);
    });
});

    // Function to handle the 'click' event on the 'menu-toggle' div
    function toggleMenu() {
        if (subMenu.style.maxHeight) {
            subMenu.style.maxHeight = null;
            menuIcon.classList.remove('rotated');
        } else {
            subMenu.style.maxHeight = subMenu.scrollHeight + "px";
            menuIcon.classList.add('rotated');
        }
    }

    // Add 'click' event listener to 'menu-toggle' div
    menuToggle.addEventListener("click", toggleMenu);

    // Function for logging out
    function logOut() {
        if (confirm("Are you sure you want to log out?")) {
            window.location.href = "index.php?logout=true";
        }
    }
    // Add click event handlers to the list items
  listItems.forEach(item => {
    item.addEventListener('click', function() {
      // Get the data-page attribute value
      const dataPage = this.getAttribute('data-page');

      // Construct the URL with .php extension
      const url = dataPage + '.php';

      // Set the iframe source to the constructed URL and target it
      iframe.src = url;
      iframe.name = 'iframe';
    });
  });