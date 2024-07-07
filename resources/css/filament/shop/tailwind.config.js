import preset from '../../../../vendor/filament/filament/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/Shop/**/*.php',
        './resources/views/filament/shop/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
}
