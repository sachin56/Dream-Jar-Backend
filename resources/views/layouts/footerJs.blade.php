<script src="{{ url(env('ASSETS_PATH').'/js/vendors.bundle.js') }}"></script>
<script src="{{ url(env('ASSETS_PATH').'/js/app.bundle.js') }}"></script>
{{-- <script src="{{ url(env('ASSETS_PATH').'/js/sidebarActive.js') }}"></script> --}}
<script src="{{ url(env('ASSETS_PATH').'/js/parsley.min.js') }}" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- Sweet Alert---}}
<script src="{{ url(env('ASSETS_PATH').'/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<script src="{{ url(env('ASSETS_PATH').'/js/datagrid/datatables/datatables.bundle.js') }}"></script>

<!-- page select 2 js below -->
<script src="{{ url(env('ASSETS_PATH').'/js/formplugins/select2/select2.bundle.js') }}"></script>

<!-- page datepicker js below -->
<script src="{{ url(env('ASSETS_PATH').'/js/miscellaneous/fullcalendar/fullcalendar.bundle.js') }}"></script>

<!-- page ssummer note js below -->
<script src="{{ url(env('ASSETS_PATH').'/libs/summernote-0.9.0-dist/summernote.min.js') }}"></script>


<!-- common scripts -->
<script src="{{ url(env('ASSETS_PATH').'/js/common.js') }}"></script>

<script src="{{ url(env('ASSETS_PATH').'/js/moment.min.js') }}"></script>


<script>
    window.onload = function() {
        document.getElementById("preloader").style.display = "none";
    };
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['fontsize', ['fontsize', 'height', 'color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['codeview', 'help']],
                ['custom', []] 
            ],
        });
    });

    $(document).ready(function() {
        const videoUrl = "{{ Auth::user() && Auth::user()->role ? Auth::user()->role->video_link : '' }}";

        $('#videoModal').on('show.bs.modal', function () {
            if (videoUrl) {
                $('#roleVideoFrame').attr('src', getEmbedUrl(videoUrl));
            }
        });

        $('#videoModal').on('hidden.bs.modal', function () {
            $('#roleVideoFrame').attr('src', '');
        });

        function getEmbedUrl(url) {
            let embedUrl = url;
            if (url.includes('youtube.com/watch')) {
                const videoId = new URL(url).searchParams.get('v');
                embedUrl = `https://www.youtube.com/embed/${videoId}`;
            } else if (url.includes('youtu.be')) {
                const videoId = url.substring(url.lastIndexOf('/') + 1);
                embedUrl = `https://www.youtube.com/embed/${videoId}`;
            } else if (url.includes('vimeo.com')) {
                const videoId = url.substring(url.lastIndexOf('/') + 1);
                embedUrl = `https://player.vimeo.com/video/${videoId}`;
            }
            return embedUrl;
        }
    });
</script>








