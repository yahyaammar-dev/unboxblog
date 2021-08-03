
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

<script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>

<script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>









<link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

<script src="https://cdn.plyr.io/3.6.8/plyr.js"></script>

<script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>


<div class="container">

<div class="layoutContent clearfix">
    
    <div class="layoutContent-main hasRightSidebar">
        <div class="container video-container">
            <video controls crossorigin playsinline poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg">
                <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" size="576">
                    <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" size="720">
                    <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type="video/mp4" size="1080">

                    <!-- Caption files -->
                    <track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                            default>
                    <track kind="captions" label="Français" srclang="fr" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">
                    <!-- Fallback for browsers that don't support the <video> element -->
                    <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download>Download</a>
            </video>
        </div>
    <!-- Plyr resources and browser polyfills are specified in the pen settings -->
    </div>

    <div class="layoutContent-sidebar sidebar sidebar--right js-sticky-sidebar">

    </div>

</div>

</div>







<script>

    // Change the second argument to your options:
    // https://github.com/sampotts/plyr/#options
    const player = new Plyr('video', {captions: {active: true}});

    // Expose player so it can be used from the console
    window.player = player;


</script>