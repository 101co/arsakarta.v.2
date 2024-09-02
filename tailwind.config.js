import preset from './vendor/filament/support/tailwind.config.preset'
 
export default {
    presets: [preset],
    content: {
      files: [
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
      ]
    },
    plugins: [
        require('flowbite/plugin'),
    ],
    theme: {
      extend: {
        keyframes: {
          fadeIn: {
            '0%': { opacity: '0' },
            '100%': { opacity: '1' },
          },
        },
        animation: {
          fadeIn: 'fadeIn 0.5s ease-in-out',
        },
      },
    },
}