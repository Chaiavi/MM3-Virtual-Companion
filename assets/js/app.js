$(document).ready(function() {
    // Track which content has been loaded
    var loadedContent = {
        items: false,
        map: false,
        notes: false,
        keyboard: false,
        tracker: false
    };
    // Track if a request is in progress
    var loadingInProgress = false;
    var REQUEST_DELAY = 300;

    // Function to load content with rate limiting
    function loadContent(contentId, phpFile, contentKey) {
        // Check if already loaded
        if (loadedContent[contentKey]) {
            return Promise.resolve();
        }

        // Check if another request is in progress
        if (loadingInProgress) {
            return new Promise((resolve) => {
                setTimeout(() => {
                    loadContent(contentId, phpFile, contentKey).then(resolve);
                }, REQUEST_DELAY);
            });
        }

        // Set loading flag
        loadingInProgress = true;
        $(contentId).html('<div class="loading">Loading</div>');

        // Return a promise for the load operation
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                $(contentId).load(phpFile, function(response, status, xhr) {
                    loadingInProgress = false;
                    if (status == "error") {
                        $(this).html('<div style="text-align: center; padding: 40px; color: #dc3545;">Error loading content: ' + xhr.status + " " + xhr.statusText + '</div>');
                        reject(xhr);
                    } else {
                        loadedContent[contentKey] = true;
                        resolve();
                    }
                });
            }, REQUEST_DELAY);
        });
    }

    // Initialize empty containers
    $('#items-content, #map-content, #notes-content, #keyboard-content, #tracker-content')
        .html('<div style="text-align: center; padding: 40px; color: #666;">Click to load content</div>');
    
    // Initially show items container
    $('#map-content, #notes-content, #keyboard-content, #tracker-content').hide();
    $('#items-content').show();

    // Load items calculator on page load
    loadContent('#items-content', 'itemsCalculator.php', 'items');
    $('#btnItems').addClass('active');

    // Navigation handlers
    $('#btnMap').on('click', function() {
        var btn = this;
        $(btn).prop('disabled', true);
        loadContent('#map-content', 'maps.php', 'map').then(() => {
            showContent('#map-content');
            setActiveButton(btn);
            $(btn).prop('disabled', false);
        }).catch(() => {
            $(btn).prop('disabled', false);
        });
        return false; // Prevent default action
    });

    $('#btnItems').on('click', function() {
        var btn = this;
        $(btn).prop('disabled', true);
        loadContent('#items-content', 'itemsCalculator.php', 'items').then(() => {
            showContent('#items-content');
            setActiveButton(btn);
            $(btn).prop('disabled', false);
        }).catch(() => {
            $(btn).prop('disabled', false);
        });
    });

    $('#btnNotes').on('click', function() {
        var btn = this;
        $(btn).prop('disabled', true);
        loadContent('#notes-content', 'notes.php', 'notes').then(() => {
            showContent('#notes-content');
            setActiveButton(btn);
            $(btn).prop('disabled', false);
        }).catch(() => {
            $(btn).prop('disabled', false);
        });
    });

    $('#btnKeyboard').on('click', function() {
        var btn = this;
        $(btn).prop('disabled', true);
        loadContent('#keyboard-content', 'keyboard.php', 'keyboard').then(() => {
            showContent('#keyboard-content');
            setActiveButton(btn);
            $(btn).prop('disabled', false);
        }).catch(() => {
            $(btn).prop('disabled', false);
        });
    });

    $('#btnTracker').on('click', function() {
        var btn = this;
        $(btn).prop('disabled', true);
        loadContent('#tracker-content', 'tracker.php', 'tracker').then(() => {
            showContent('#tracker-content');
            setActiveButton(btn);
            $(btn).prop('disabled', false);
        }).catch(() => {
            $(btn).prop('disabled', false);
        });
    });

    function showContent(activeContent) {
        $('#items-content, #map-content, #notes-content, #keyboard-content, #tracker-content').hide();
        $(activeContent).show();
    }

    function setActiveButton(activeBtn) {
        $('.nav-tabs button').removeClass('active');
        $(activeBtn).addClass('active');
    }
});
