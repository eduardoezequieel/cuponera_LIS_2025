import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: "#7A7AF9",
                secondary: "#1D1F49",
                background: "#0E1024",
                textMuted: "#B7B9CA",
                border: "#38394D",
                inputBackground: "#141633",
            },
        },
    },

    plugins: [forms],
};
