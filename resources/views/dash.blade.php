<!DOCTYPE html>
<html lang="en">
@include('components.dashboard.head-tag')

<body>
    <div id="main-wrapper">
        <div id="preloader">
            <div class="loader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                        stroke-miterlimit="10" />
                </svg>
            </div>
        </div>
        @include('components.dashboard.nav-header')
        @include('components.dashboard.header')
        @include('components.dashboard.nk-sidebar')
        @include('components.dashboard.content-body')
        @include('components.dashboard.footer')
    </div>
    @include('components.dashboard.js-includes')
</body>

</html>
