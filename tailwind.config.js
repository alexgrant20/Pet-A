/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  safelist: [
    "text-blue-600",
    "text-blue-900",
    "flex",
    "flex-wrap",
    "text-sm",
    "font-medium",
  ],
  theme: {
    extend: {
      spacing: {
        100: "25rem",
        128: "32rem",
        144: "36rem",
      },
    },
    fontFamily: {
      sans: ["Roboto", "sans-serif"],
    },
  },
  plugins: [require("daisyui"), require("@tailwindcss/typography")],
  daisyui: {
    themes: [
      {
        customTheme: {
          primary: "#e37b58",
          "primary-focus": "#e37b58",
          secondary: "#939f5c",
          accent: "#6d213c",
          neutral: "#c287e8",
          "base-100": "#fff8f0",
          "base-200": "#FFF8E5",
          "base-300": "#e6e0da",
          "primary-content": "#fff8f0",
        },
      },
    ],
  },
};
