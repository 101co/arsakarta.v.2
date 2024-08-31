import preset from './vendor/filament/support/tailwind.config.preset'
 
export default {
    presets: [preset],
    content: [
        './vendor/filament/**/*.blade.php',
        './vendor/jaocero/radio-deck/resources/views/**/*.blade.php',
        "./node_modules/flowbite/**/*.js",
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/components/layouts/**/*.blade.php",
        "./resources/**/*.blade.php",
        './resources/views/*.blade.php',
        './resources/views/viewer/*.blade.php',
    ],
    plugins: [
        require('flowbite/plugin')
    ]
}