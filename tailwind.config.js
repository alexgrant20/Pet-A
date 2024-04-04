/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("daisyui")],
    daisyui: {
        themes: [
            {
                customTheme: {
                    primary: "#e37b58",
                    secondary: "#939f5c",
                    accent: "#6d213c",
                    neutral: "#c287e8",
                    "base-100": "#fff8f0",
                    "base-200": "#fff9f2",
                    'primary-content': '#fff8f0',
                },
            },
        ],
    },
};
