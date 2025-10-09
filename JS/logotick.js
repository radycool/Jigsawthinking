jQuery(document).ready(function ($) {
    $('.logo-ticker-track').each(function () {
        let $track = $(this);
        let content = $track.html();
        // Duplicate for infinite effect
        $track.append(content);
    });
});
