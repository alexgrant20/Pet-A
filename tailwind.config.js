/** @type {import('tailwindcss').Config} */
export default {
   content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./src/**/*.{js,ts,jsx,tsx}",
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
   ],
   safelist: [
      "text-blue-600",
      "text-primary",
      "text-secondary",
      "text-accent",
      "text-red-400",
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
         colors: {
            transparent: "transparent",
            white: "#FFFFFF",
            "white-gray": "#e2e4e6",
         },
      },
      fontFamily: {
         sans: ["SFPro", "Roboto"],
      },
   },
   plugins: [
      require("daisyui"),
   ],
   daisyui: {
      themes: [
         {
            customTheme: {
               primary: "#e37b58",
               "primary-focus": "#e37b58",
               secondary: "#58c0e3",
               accent: "#ff6d3c",
               neutral: "#9d9d9d",
               "base-100": "#fff8f0",
               "base-200": "#FFF8E5",
               "base-300": "#f2ecea",
               "primary-content": "#fff8f0",
            },
         },
      ],
   },
};
