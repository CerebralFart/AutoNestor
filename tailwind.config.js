const colors = require("tailwindcss/colors");
module.exports = {
    mode: "jit",
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js'
    ],
    darkMode: false, // or 'media' or 'class'
    theme: {
        colors: {
            black: '#000000',
            white: '#FFFFFF',
            gray: colors.warmGray,
            blue: {
                100: '#D0E7FF',
                200: '#A2CFFE',
                300: '#73B8FE',
                400: '#2E96FB',
                500: '#0581FD',
                600: '#0468C8',
                700: '#0252A2',
                800: '#003B72',
                900: '#002B55'
            },
            green: {
                100: '#D2EEE9',
                200: '#8CD5CA',
                300: '#5DC1B4',
                400: '#30B3A0',
                500: '#02A38A',
                600: '#008C76',
                700: '#007766',
                800: '#015A4C',
                900: '#003C33',
            },
            purple: {
                100: '#DFDEFE',
                200: '#C1BDFE',
                300: '#938DFA',
                400: '#756CFA',
                500: '#564CFA',
                600: '#483ECD',
                700: '#3831A1',
                800: '#292372',
                900: '#1F1C5D',
            },
            red: {
                100: '#FFCFE0',
                200: '#FFA4C0',
                300: '#FF74A1',
                400: '#FF4783',
                500: '#EB024C',
                600: '#D60345',
                700: '#B6053A',
                800: '#960131',
                900: '#740128',
            },
            yellow: {
                100: '#FDE2B9',
                200: '#FDCD8B',
                300: '#FFB95F',
                400: '#FFA431',
                500: '#FD9100',
                600: '#E78400',
                700: '#D17800',
                800: '#BF6610',
                900: '#9B540B',
            }
        },
    },
    variants: {
        extend: {},
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
