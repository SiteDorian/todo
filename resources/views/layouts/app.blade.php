<!DOCTYPE html>
<html>
    <head>
        @include('includes.head')
    </head>

    <body>
        @include('includes.header')

        <div class="container" id="app">
            @yield("content")

            <footer class="row">
                @include('includes.footer')
            </footer>
        </div>
        <script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>