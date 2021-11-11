<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 301.3 59.93" width="148"><defs><style>.cls-1{fill:#1f4ee5;}</style></defs><g id="Layer_2" data-name="Layer 2"><g id="Layer_1-2" data-name="Layer 1"><path d="M93.26,8.42A14.58,14.58,0,0,0,78.68,23V42.25h6.26V23h0a8.32,8.32,0,0,1,16.63,0h0V42.25h6.26V23A14.57,14.57,0,0,0,93.26,8.42Z"></path><path d="M255.55,43.09a14.58,14.58,0,0,0,14.58-14.58V9.26h-6.27V28.51h0a8.31,8.31,0,1,1-16.62,0h0V9.26H241V28.51A14.58,14.58,0,0,0,255.55,43.09Z"></path><circle class="cls-1" cx="3.74" cy="20.59" r="3.74"></circle><path d="M25.12,8.42A14.57,14.57,0,0,0,10.55,23V33.4a13.79,13.79,0,0,1-3.46-4.61H.39A20.15,20.15,0,0,0,10.55,40.91v19h6.26V42.87A20.06,20.06,0,0,0,39.7,23,14.58,14.58,0,0,0,25.12,8.42Zm7,20.37a13.79,13.79,0,0,1-15.34,7.74V23h0a8.32,8.32,0,0,1,16.63,0h0A13.71,13.71,0,0,1,32.15,28.79Z"></path><rect x="66.61" y="9.26" width="6.27" height="32.99"></rect><path d="M125.16,0H118.9V9.26h-7.24v5.43h7.24V31.88c0,1.35.06,2.68.17,4a8.46,8.46,0,0,0,1.12,3.59,6.81,6.81,0,0,0,2.92,2.61,12.62,12.62,0,0,0,5.6,1,20.52,20.52,0,0,0,2.75-.25,8,8,0,0,0,2.89-.87V36.26a6.47,6.47,0,0,1-2.16.77,13.09,13.09,0,0,1-2.29.21,4.75,4.75,0,0,1-2.75-.66,3.9,3.9,0,0,1-1.39-1.74,7.1,7.1,0,0,1-.53-2.44c0-.9-.07-1.82-.07-2.75v-15h9.19V9.26h-9.19Z"></path><path d="M300.57,28.82a7.93,7.93,0,0,0-2-2.72,10.72,10.72,0,0,0-3.06-1.81,30.61,30.61,0,0,0-3.79-1.18l-2.51-.49a12.91,12.91,0,0,1-2.75-.83,7.49,7.49,0,0,1-2.23-1.46,3.19,3.19,0,0,1-.94-2.37,3,3,0,0,1,1.64-2.75,7.59,7.59,0,0,1,3.86-.94,7.87,7.87,0,0,1,4,.94,9.31,9.31,0,0,1,2.75,2.33l4.88-3.69a10.09,10.09,0,0,0-4.88-4.17,16.64,16.64,0,0,0-6.4-1.26,16.94,16.94,0,0,0-4.56.63,12.92,12.92,0,0,0-4,1.88,9.54,9.54,0,0,0-2.85,3.17,9,9,0,0,0-1.08,4.48,8.45,8.45,0,0,0,.84,4,7.74,7.74,0,0,0,2.22,2.65,11.9,11.9,0,0,0,3.21,1.67A39.06,39.06,0,0,0,286.68,28c.7.14,1.5.32,2.41.52a16.11,16.11,0,0,1,2.57.84,6.27,6.27,0,0,1,2.09,1.43,3.15,3.15,0,0,1,.87,2.29,3,3,0,0,1-.59,1.85,4.91,4.91,0,0,1-1.53,1.32,7.36,7.36,0,0,1-2.16.77,12.36,12.36,0,0,1-2.4.24,8.48,8.48,0,0,1-4.6-1.18,19.68,19.68,0,0,1-3.41-2.72l-4.73,3.9a12.89,12.89,0,0,0,5.53,4.59,19.07,19.07,0,0,0,7.21,1.26,21.38,21.38,0,0,0,4.83-.56,12.8,12.8,0,0,0,4.29-1.81,9.89,9.89,0,0,0,3.06-3.24,9.11,9.11,0,0,0,1.18-4.76A9.3,9.3,0,0,0,300.57,28.82Z"></path><path d="M217.84,8.42a17.34,17.34,0,1,0,17.33,17.34A17.34,17.34,0,0,0,217.84,8.42Zm0,28.4a11.07,11.07,0,1,1,11.07-11.06A11.07,11.07,0,0,1,217.84,36.82Z"></path><path d="M156.83,8.42a17.34,17.34,0,1,0,12,29.82l-4-4.86a11,11,0,0,1-18.69-4.91h27.79a17.18,17.18,0,0,0-17.1-20ZM146.14,23a11,11,0,0,1,21.39,0Z"></path><path d="M58.62,8.42A14.58,14.58,0,0,0,44,23V42.25h6.27V23h0a8.32,8.32,0,0,1,8.31-8.31,8.41,8.41,0,0,1,2.52.4V8.65A14,14,0,0,0,58.62,8.42Z"></path><path d="M193.73,8.42A14.57,14.57,0,0,0,179.16,23V42.25h6.26V23h0a8.29,8.29,0,0,1,10.83-7.91V8.65A14,14,0,0,0,193.73,8.42Z"></path></g></g></svg>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-5">
                </div>

                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">
                            <svg fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" class="-mt-px w-5 h-5 text-gray-400">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>

                            <a href="https://laravel.bigcartel.com" class="ml-1 underline">
                                Shop
                            </a>

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="ml-4 -mt-px w-5 h-5 text-gray-400">
                                <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>

                            <a href="https://github.com/sponsors/taylorotwell" class="ml-1 underline">
                                Sponsor
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        Printerous
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
